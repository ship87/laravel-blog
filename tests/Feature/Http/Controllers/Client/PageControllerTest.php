<?php

namespace Tests\Feature\Http\Controllers\Client;

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

    public function testPage()
    {
        $this->get('/'.str_slug($this->page->slug))->assertStatus(200);
    }
}
