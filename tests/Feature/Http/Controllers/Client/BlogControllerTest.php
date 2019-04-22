<?php

namespace Tests\Feature\Http\Controllers\Client;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use Tests\PostCreate;
use Tests\TestCase;

class BlogControllerTest extends TestCase
{
    use DatabaseTransactions, PostCreate;

    protected function setUp()
    {
        parent::setUp();

        $this->createPost();
    }

    public function testIndex()
    {
        $this->get(config('app.url_blog'))->assertStatus(200);
    }

    public function testIndexArchive()
    {
        $this->get(config('app.url_blog').'/archive')->assertStatus(200);
    }

    public function testIndexCategory()
    {
        $this->get(config('app.url_blog').'/category')->assertStatus(200);
    }

    public function testPost()
    {
        $this->get(config('app.url_blog').'/'.$this->post->id.'/'.$this->post->slug)->assertStatus(200);
    }
}
