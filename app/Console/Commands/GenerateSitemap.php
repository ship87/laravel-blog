<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\Filesystem;

use App\Services\PageService;
use App\Services\PostService;
use Illuminate\Support\Carbon;

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
 
http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">\r\n';

    private $secondaryPageBody = '
<url>
    <loc>%s</loc>
    <lastmod>%s</lastmod>
    <changefreq>%s</changefreq>
    <priority>%s</priority>
</url>\r\n';

    private $secondaryPageFooter = '</urlset>';

    private $postService;

    private $pageService;

    private $filesystem;

    private $countPage = 1;

    private $currentSecondaryPage = 1;

    private $leftOutLimitPage = 0;

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

        //echo memory_get_usage(true)/pow(1024, 1).'<br>';

        $posts = $this->postService->getAll();
        $pages = $this->pageService->getAll();

        $totalCountPages = (int) $pages->count() + (int) $posts->count();

        $countSecondaryPages = $this->getCountSecondaryPages($totalCountPages);

        $this->deleteSitemapFiles($countSecondaryPages);

        $this->generateMainPage($countSecondaryPages);

        $this->generateSecondaryPages($posts, 'posts');

        $res = $this->generateSecondaryPages($pages, 'pages');

        echo $res;
        //dd($totalCountPages);
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

    private function generateSecondaryPages($pages, $type)
    {

        $filePageSitemap = 'sitemap'.$this->currentSecondaryPage.'.xml';
        $this->filesystem->append($filePageSitemap, $this->secondaryPageHeader);

        foreach ($pages as $page) {

            $pageData = sprintf($this->secondaryPageBody, config('app.url'), $page->updated_at->toRfc3339String(), config('app.sitemap_'.$type.'_changefrequency'), config('app.sitemap_'.$type.'_priority'));

            $this->filesystem->append($filePageSitemap, $pageData);

        }

        $this->filesystem->append($filePageSitemap, $this->secondaryPageFooter);

    }

    private function getCountSecondaryPages($totalCountPages)
    {

        $countSecondaryPages = floor($totalCountPages / $this->countPage);

        $extraPage = $totalCountPages % $this->countPage;

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
