<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer(config('app.theme').'client.widgets.categories', 'App\Http\ViewComposers\CategoryComposer');

        View::composer(config('app.theme').'client.widgets.last-comments', 'App\Http\ViewComposers\LastCommentsComposer');
    }

    public function register()
    {

    }
}