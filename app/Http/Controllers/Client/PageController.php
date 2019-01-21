<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Services\PageService;

class PageController extends Controller
{
    public function page(Request $request, PageService $pageService, $any = false)
    {

        $urlArr = $request->segments();
        $lastSlug = array_pop($urlArr);

        $pageData = $pageService->getPage($lastSlug);
        if (! $pageData) {
            abort(404);
        }

        $resultUrl = $pageService->checkUrl($urlArr, $lastSlug);
        if ($resultUrl !== $any) {
            abort(404);
        }

        return view(config('app.theme').'/client/page', ['pageData' => $pageData]);
    }
}
