<?php

namespace Tests\Feature\Http\Controllers\Api;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use Tests\PageCreate;
use Tests\TestCase;

class PageControllerTest extends TestCase
{
    use DatabaseTransactions, PageCreate;

    protected function setUp()
    {
        parent::setUp();

        $this->createPage();
    }

    public function testIndex()
    {

        $this->actingAs($this->user)->get('/api/v1/pages/')->assertStatus(200);
    }

    public function testShow()
    {

        $this->actingAs($this->user)->get('/api/v1/pages/'.$this->page->id)->assertStatus(200);
    }
}
