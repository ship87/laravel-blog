<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use App\Http\Controllers\Controller;
use App\Services\PageService;

class PageController extends Controller
{
    public function page(Request $request, PageService $pageService, $any = false)
    {

        $urlArr = $request->segments();

        $staticPage = $this->staticPage($urlArr);

        if ($staticPage) {
            return view($staticPage);
        }

        $lastSlug = array_pop($urlArr);

        $pageData = $pageService->getPage($lastSlug);
        if (! $pageData) {
            abort(404);
        }

        $resultUrl = $pageService->checkUrl($urlArr, $lastSlug);
        if ($resultUrl !== $any) {
            abort(404);
        }

        return view(config('app.theme').'client/page/page', ['pageData' => $pageData]);
    }

    private function staticPage($urlArr)
    {

        $url = config('app.theme').'client/pages/'.implode('/', $urlArr);

        if (View::exists($url)) {
            return $url;
        }

        return false;
    }
}
