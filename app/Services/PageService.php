<?php

namespace App\Services;

use App\Repositories\PageRepository;
use App\Repositories\MetatagRepository;

use App\Traits\ClientActions;

class PageService
{
    use ClientActions;

    public function __construct(PageRepository $pageRepo, MetatagRepository $metatagRepo)
    {
        $this->baseRepo = $pageRepo;
        $this->metatagRepo = $metatagRepo;
    }

    public function show($id)
    {
        $result = $this->baseRepo->show($id);

        return $result;
    }

    public function getBySlug($slug)
    {
        $page = $this->baseRepo->getByParam([
            'slug' => $slug,
        ]);

        return $page;
    }

    public function getUrl($slug)
    {
        return $this->baseRepo->getUrl($slug);
    }

    public function checkUrl($urlArr, $lastSlug)
    {
        $resultUrl = '';
        foreach ($urlArr as $url) {
            $page = $this->getUrl($url);
            $resultUrl = $resultUrl.$page->slug.'/';
        }

        return $resultUrl.$lastSlug;
    }

}