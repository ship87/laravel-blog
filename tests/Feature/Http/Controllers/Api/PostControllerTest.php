<?php

namespace Tests\Feature\Http\Controllers\Api;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use Tests\PostCreate;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use DatabaseTransactions, PostCreate;

    protected function setUp()
    {
        parent::setUp();

        $this->createPost();
    }

    public function testIndex()
    {

        $this->actingAs($this->user)->get('/api/v1/posts/')->assertStatus(200);
    }

    public function testShow()
    {

        $this->actingAs($this->user)->get('/api/v1/posts/'.$this->post->id)->assertStatus(200);
    }
}
