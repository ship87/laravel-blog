<?php

namespace Tests;

use App\Models\Page;
use App\Models\User;

trait PageCreate
{
    protected $page;

    protected $user;

    public function createPage()
    {

        $this->user = factory(User::class)->create();

        $this->page = factory(Page::class)->create([
            'created_user_id' => $this->user->id,
            'updated_user_id' => $this->user->id,
        ]);
    }
}
