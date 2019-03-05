<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Models\Post;
use App\Models\Page;
use App\Models\PostComment;
use App\Models\PageComment;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Metatag;
use App\Models\User;
use App\Models\Role;
use App\Policies\PostPolicy;
use App\Policies\PagePolicy;
use App\Policies\PageCommentPolicy;
use App\Policies\PostCommentPolicy;
use App\Policies\TagPolicy;
use App\Policies\MetatagPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\UserPolicy;
use App\Policies\RolePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
		Page::class => PagePolicy::class,
		Post::class => PostPolicy::class,
		PageComment::class => PageCommentPolicy::class,
		PostComment::class => PostCommentPolicy::class,
		Category::class => CategoryPolicy::class,
		Tag::class => TagPolicy::class,
		Metatag::class => MetatagPolicy::class,
		User::class => UserPolicy::class,
		Role::class => RolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
