<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use Tests\PostCreate;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use DatabaseTransactions, PostCreate;

    protected function setUp()
    {
        parent::setUp();
    }

    public function testIndex()
    {

        $this->createPost();

        $this->actingAs($this->user)->get(config('app.url_admin').'/posts/')->assertStatus(200);
    }

    public function testCreate()
    {
        $this->createPost();

        $this->actingAs($this->user)->get(config('app.url_admin').'/posts/create/')->assertStatus(200);
    }

    public function testEdit()
    {
        $this->createPost();

        $this->actingAs($this->user)->get(config('app.url_admin').'/posts/'.$this->post->id.'/edit/')->assertStatus(200);
    }
}
