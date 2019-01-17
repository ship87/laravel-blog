<?php

namespace App\Http\Controllers;

use App\Services\PageService;
use Illuminate\Http\Request;

class PageController extends Controller
{
	public function page(PageService $pageService, $slug=false)
	{
		$page = $pageService->getPage($slug);

		if (!$page) {
			abort(404);
		}

		return view('client/page', ['page' => $page]);
	}
}
