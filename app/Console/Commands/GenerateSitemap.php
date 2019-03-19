<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\Filesystem\Filesystem;

use App\Services\PageService;
use App\Services\PostService;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemap';

    private $mainPageHeader = '<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    private $mainPageBody = ' <sitemap>
      <loc>%s/sitemap%s.xml</loc>
      <lastmod>%s</lastmod>
   </sitemap>
';

    private $mainPageFooter = '</sitemapindex>';

    private $secondaryPageHeader = '<?xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
 
http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

    private $secondaryPageBody = '
<url>
    <loc>%s</loc>
    <lastmod>%s</lastmod>
    <changefreq>%s</changefreq>
    <priority>%s</priority>
</url>';

    private $secondaryPageFooter = '</urlset>';

    private $postService;

    private $pageService;

    private $filesystem;

    private $currentSecondaryPage = 1;

    private $countPageOnCurrent = 1;

    private $filePageSitemap = 'sitemap%s.xml';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(PostService $postService, PageService $pageService, Filesystem $filesystem)
    {
        parent::__construct();

        $this->postService = $postService;
        $this->pageService = $pageService;
        $this->filesystem = $filesystem;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Generate sitemap for all pages. Might take a while...');

        $posts = $this->postService->addUrl($this->postService->getAll());
        $pages = $this->pageService->getAll();

        $totalCountPages = (int) $pages->count() + (int) $posts->count();

        $countSecondaryPages = $this->getCountSecondaryPages($totalCountPages);

        $this->deleteSitemapFiles($countSecondaryPages);

        $this->generateMainPage($countSecondaryPages);

        $this->generateSecondaryPageHeaderBody($posts, 'posts');

        $this->generateSecondaryPageHeaderBody($pages, 'pages');

        $this->generateSecondaryPageFooter($countSecondaryPages);
    }

    private function generateMainPage($countSecondaryPages)
    {
        $data = $this->mainPageHeader;

        for ($page = 1; $page <= $countSecondaryPages; $page++) {
            $data .= sprintf($this->mainPageBody, config('app.url'), $page, Carbon::now()->toRfc3339String());
        }

        $data .= $this->mainPageFooter;

        $this->filesystem->append('sitemap.xml', $data);

        return $data;
    }

    private function generateSecondaryPageHeaderBody($pages, $type)
    {
        foreach ($pages as $page) {

            $filename = sprintf($this->filePageSitemap, $this->currentSecondaryPage);

            switch ($type) {
                case 'pages':
                    $url = config('app.url').$this->pageService->getUrlByPage($page);
                    break;
                case 'posts':
                    $url = config('app.url').$page->url;
                    break;
            }

            $pageData = sprintf($this->secondaryPageBody, $url, $page->updated_at->toRfc3339String(), config('app.sitemap_'.$type.'_changefrequency'), config('app.sitemap_'.$type.'_priority'));

            switch ($this->countPageOnCurrent) {
                case 1:
                    $this->filesystem->append($filename, $this->secondaryPageHeader);
                    break;
                case config('app.sitemap_count_pages'):
                    $this->countPageOnCurrent = 0;
                    $this->currentSecondaryPage++;
                    break;
            }

            $this->filesystem->append($filename, $pageData);

            $this->countPageOnCurrent++;
        }
    }

    private function generateSecondaryPageFooter($countSecondaryPages)
    {
        for ($page = 1; $page <= $countSecondaryPages; $page++) {
            $this->filesystem->append(sprintf($this->filePageSitemap, $page), $this->secondaryPageFooter);
        }
    }

    private function getCountSecondaryPages($totalCountPages)
    {
        $countSecondaryPages = floor($totalCountPages / config('app.sitemap_count_pages'));

        $extraPage = $totalCountPages % config('app.sitemap_count_pages');

        if ($extraPage > 0) {
            $countSecondaryPages++;
        }

        return $countSecondaryPages;
    }

    private function deleteSitemapFiles($totalCountPages)
    {
        $numFile = '';
        do {
            $this->filesystem->delete('sitemap'.$numFile.'.xml');
            $numFile++;
        } while ($numFile <= $totalCountPages);
    }
}
