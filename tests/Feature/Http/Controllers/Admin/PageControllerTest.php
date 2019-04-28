<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use Tests\PageCreate;
use Tests\TestCase;

class PageControllerTest extends TestCase
{
    use DatabaseTransactions, PageCreate;

    protected function setUp()
    {
        parent::setUp();
    }

    public function testCreate()
    {
        $this->createPage();

        $this->actingAs($this->user)->get(config('app.url_admin').'/pages/create/')->assertStatus(200);
    }

    public function testIndex()
    {
        $this->createPage();

        $this->actingAs($this->user)->get(config('app.url_admin').'/pages/')->assertStatus(200);
    }

    public function testEdit()
    {
        $this->createPage();
        $this->actingAs($this->user)->get(config('app.url_admin').'/pages/'.$this->page->id.'/edit/')->assertStatus(200);
    }
}
