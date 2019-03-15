<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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

    private $mainPageHeader='<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    private $mainPageBody=' <sitemap>
      <loc>http://%d/sitemap%d.xml</loc>
      <lastmod>%d</lastmod>
   </sitemap>
';

    private $mainPageFooter='</sitemapindex>';

    private $secondaryPageHeader='<?xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
 
http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">\r\n';

    private $secondaryPageBody='
<url>
    <loc>http://%d/</loc>
    <lastmod>%d</lastmod>
    <changefreq>%d</changefreq>
    <priority>%d</priority>
</url>\r\n';

    private $secondaryPageFooter='</urlset>';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Generate sitemap for all pages. Might take a while...');

    }
}
