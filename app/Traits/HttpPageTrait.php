<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait HttpPageTrait
{
    private function isEmptyPaginated($pages, Request $request)
    {
        $currentPage = $request->input('page');

        if (! empty($currentPage)) {
            $currentPage = (int) $currentPage;
            if ($currentPage == 0 || $currentPage > $pages->lastPage()) {
                abort(404);
            }
        }
    }
}