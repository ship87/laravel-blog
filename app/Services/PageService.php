<?php

namespace App\Services;

use App\Repositories\PageRepository;
use App\Repositories\MetatagRepository;

use App\Traits\AdminPageTrait;
use App\Traits\ClientPageTrait;
use App\Traits\CreateUpdateUserTrait;

class PageService
{
    use AdminPageTrait;

    use ClientPageTrait;

    public function __construct(PageRepository $pageRepo, MetatagRepository $metatagRepo)
    {
        $this->baseRepo = $pageRepo;
        $this->metatagRepo = $metatagRepo;
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

    public function getAllTitleId()
    {
        return $this->baseRepo->getAllTitleId();
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

    public function update(array $data, array $relationData, $id, $auth)
    {

        $data['updated_user_id'] = $auth->id;

        $page = $this->baseRepo->update($data, $id);

        if (! $page) {
            return false;
        }

        $this->saveRelationData($page, $relationData);

        return $page;
    }

    public function create(array $data, array $relationData, $auth)
    {

        $data['created_user_id'] = $data['updated_user_id'] = $auth->id;

        $page = $this->baseRepo->create($data);

        if (! $page) {
            return false;
        }

        $this->saveRelationData($page, $relationData);

        return $page;
    }

    private function saveRelationData($page, array $relationData)
    {
        $this->metatagRepo->saveManyPage($page->id, [
            'title' => $relationData['seotitle'],
            'description' => $relationData['seodescription'],
            'keywords' => $relationData['seokeywords'],
        ]);
    }
}