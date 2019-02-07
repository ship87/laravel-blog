<?php

namespace App\Traits;
use Illuminate\Http\Request;

trait HttpPageTrait
{
    private function isEmptyPage($page)
    {
        if (!$page) {
            abort(404);
        }
    }

    private function isEmptyPaginated($pages, Request $request)
    {
        $this->isEmptyPage($pages);

        $currentPage = $request->input('page');

        if (! empty($currentPage)) {
            $currentPage = (int) $currentPage;
            if ($currentPage == 0 || $currentPage > $pages->lastPage()) {
                abort(404);
            }
        }
    }
}