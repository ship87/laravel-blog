<?php

namespace App\Http\Controllers;

use App\Services\PageService;
use Illuminate\Http\Request;

class PageController extends Controller
{
	public function page(Request $request,PageService $pageService, $any=false)
	{

		$urlArr=$request->segments();
		$lastSlug = array_pop($urlArr);

		$pageData = $pageService->getPage($lastSlug);
		if (!$pageData) {
			abort(404);
		}

		$resultUrl=$pageService->checkUrl($urlArr,$lastSlug);
		if ($resultUrl!==$any) {
			abort(404);
		}

		return view('client/page', ['pageData' => $pageData]);
	}
}
