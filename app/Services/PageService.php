<?php

namespace App\Services;

use App\Repositories\PageRepository;
use App\Repositories\MetatagRepository;

use App\Traits\AdminPageTrait;
use App\Traits\ClientPageTrait;
use App\Traits\CreateUpdateSlugTrait;
use App\Traits\IncludeRelateResourceTrait;
use App\Traits\FilterDataTrait;
use App\Traits\SortDataTrait;

class PageService
{
    use AdminPageTrait;

    use ClientPageTrait;

    use CreateUpdateSlugTrait;

    use IncludeRelateResourceTrait;

    use FilterDataTrait;

    use SortDataTrait;

    protected $relatedResources = [
        'comments' => '\\App\\Http\\Resources\\PageComment\\PageCommentResource',
        'metatags' => '\\App\\Http\\Resources\\Metatag\\MetatagResource',
        'createdUser' => '\\App\\Http\\Resources\\User\\UserResource',
        'updatedUser' => '\\App\\Http\\Resources\\User\\UserResource',
    ];

    protected $sortData = [
        'created_at' => 'ASC',
        'updated_at' => 'ASC',
    ];

    protected $whereData = [
        'title',
        'slug',
    ];

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
        $data['slug'] = $this->checkSlug($data['slug'], $data['title']);

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