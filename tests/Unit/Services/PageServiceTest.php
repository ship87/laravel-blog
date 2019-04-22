<?php

namespace Tests\Unit\Services;

use Tests\TestCase;

use App\Services\PageService;
use App\Models\Page;
use App\Repositories\PageCommentRepository;
use App\Repositories\PageRepository;
use App\Repositories\MetatagRepository;
use App\Repositories\ElasticsearchPageRepository;

class PageServiceTest extends TestCase
{
    protected $baseRepo;

    protected $pageService;

    protected function setUp()
    {
        parent::setUp();

        $baseRepo = $this->createMock(PageRepository::class);

        $page = $this->createMock(Page::class);

        $page->slug = 'page-one';

        $baseRepo->method('getUrl')->willReturn($page);

        $metatagRepo = $this->createMock(MetatagRepository::class);

        $pageCommentRepo = $this->createMock(PageCommentRepository::class);

        $elasticsearchPageRepo = $this->createMock(ElasticsearchPageRepository::class);

        $this->pageService = new PageService($baseRepo, $metatagRepo, $pageCommentRepo, $elasticsearchPageRepo);
    }

    public function testCheckUrl()
    {
        $urlArr = ['post-one'];

        $lastSlug = array_pop($urlArr);

        $checkUrl = $this->pageService->checkUrl($urlArr, $lastSlug);

        $this->assertEquals($checkUrl, 'post-one');
    }
}
