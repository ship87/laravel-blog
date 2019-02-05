<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ImageController extends Controller
{
	public function index()
	{
		return view(config('app.theme').'admin.images.index');
	}
}
