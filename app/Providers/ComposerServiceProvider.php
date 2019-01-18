<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
	/**
	 * Регистрация привязок в контейнере.
	 *
	 * @return void
	 */
	public function boot()
	{
		// Использование построителей на основе класса...
		View::composer(
			'client/page', 'App\Http\ViewComposers\ProfileComposer'
		);

		// Использование построителей на основе замыканий...
		//View::composer('dashboard', function ($view) {
		//	//
		//});
	}

	/**
	 * Регистрация сервис-провайдера.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}