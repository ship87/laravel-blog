<?php

namespace Tests\Unit\Services;

use Tests\TestCase;

use App\Services\BlogService;
use App\Repositories\PostRepository;
use App\Repositories\ElasticsearchPostRepository;

class BlogServiceTest extends TestCase
{
    protected $blogService;

    protected function setUp()
    {
        parent::setUp();

        $postRepo = $this->createMock(PostRepository::class);

        $elasticsearchPostRepo = $this->createMock(ElasticsearchPostRepository::class);

        $this->blogService = new BlogService($postRepo, $elasticsearchPostRepo);
    }

    public function testAddUrl()
    {
        $mockPostFirst = $this->getMockBuilder('Post')->getMock();

        $mockPostFirst->id = 1;
        $mockPostFirst->slug = 'post-one';

        $mockPostSecond = $this->getMockBuilder('Post')->getMock();

        $mockPostSecond->id = 2;
        $mockPostSecond->slug = 'post-two';

        $postsWithUrl = $this->blogService->addUrl([$mockPostFirst, $mockPostSecond]);

        $this->assertEquals($postsWithUrl[0]->url, url(config('app.url_blog').'/'.$mockPostFirst->id.'/'.$mockPostFirst->slug));
        $this->assertEquals($postsWithUrl[1]->url, url(config('app.url_blog').'/'.$mockPostSecond->id.'/'.$mockPostSecond->slug));
    }

    public function testGetArchiveUrl()
    {
        $yearUrl = $this->blogService->getArchiveUrl(2010);
        $yearMonthUrl = $this->blogService->getArchiveUrl(2010, 10);
        $yearMonthDayUrl = $this->blogService->getArchiveUrl(2010, 10, 1);
        $yearMonthDayDoubleUrl = $this->blogService->getArchiveUrl(2010, 10, 28);

        $this->assertEquals($yearUrl, config('app.url_blog').'/archive/2010');
        $this->assertEquals($yearMonthUrl, config('app.url_blog').'/archive/2010/10');
        $this->assertEquals($yearMonthDayUrl, config('app.url_blog').'/archive/2010/10/1');
        $this->assertEquals($yearMonthDayDoubleUrl, config('app.url_blog').'/archive/2010/10/28');
    }
}
