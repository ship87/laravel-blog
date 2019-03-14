<?php

namespace App\Services;

use App\Repositories\PageCommentRepository;
use App\Repositories\PageRepository;
use App\Repositories\MetatagRepository;
use App\Repositories\ElasticsearchPageRepository;

use App\Traits\Services\AdminPageTrait;
use App\Traits\Services\ClientPageTrait;
use App\Traits\Services\CreateUpdateSlugTrait;
use App\Traits\Services\IncludeRelateResourceTrait;
use App\Traits\Services\FilterDataTrait;
use App\Traits\Services\MergeNewDataTrait;
use App\Traits\Services\SortDataTrait;
use App\Traits\Services\SyncRelationTrait;

class PageService
{
    use AdminPageTrait, ClientPageTrait, CreateUpdateSlugTrait, IncludeRelateResourceTrait, FilterDataTrait, SortDataTrait, SyncRelationTrait, MergeNewDataTrait;

    protected $pageCommentRepo;

    protected $relatedResources = [
        'comments' => '\\App\\Http\\Resources\\PageComment\\PageCommentResource',
        'metatags' => '\\App\\Http\\Resources\\Metatag\\MetatagResource',
        'createdUser' => '\\App\\Http\\Resources\\User\\UserResource',
        'updatedUser' => '\\App\\Http\\Resources\\User\\UserResource',
    ];

    protected $sortData = [
        'created_at_asc' => 'ASC',
        'updated_at_desc' => 'DESC',
        'updated_at_asc' => 'ASC',
        'updated_at_desc' => 'DESC',
    ];

    protected $whereData = [
        'title',
        'slug',
    ];

	protected $elasticsearchPageRepo;

    public function __construct(
        PageRepository $pageRepo,
        MetatagRepository $metatagRepo,
        PageCommentRepository $pageCommentRepo,
		ElasticsearchPageRepository $elasticsearchPageRepo
    ) {
        $this->baseRepo = $pageRepo;
        $this->metatagRepo = $metatagRepo;
        $this->pageCommentRepo = $pageCommentRepo;
		$this->elasticsearchPageRepo = $elasticsearchPageRepo;
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

    public function update(array $data, array $relationData, $id, $authId, $syncRelations = false)
    {
        $data['updated_user_id'] = $authId;
        $data['slug'] = $this->checkSlug($data['slug'], $data['title'], $id);

        $page = $this->baseRepo->update($data, $id);

        if (! $page) {
            return false;
        }

        if ($syncRelations) {
            $this->syncRelations($page, $relationData);
        } else {
            $this->saveRelationData($page, $relationData);
        }

        return $page;
    }

    public function create(array $data, array $relationData, $authId, $syncRelations = false)
    {
        $data['created_user_id'] = $data['updated_user_id'] = $authId;

        $page = $this->baseRepo->create($data);

        if (! $page) {
            return false;
        }

        if ($syncRelations) {
            $this->syncRelations($page, $relationData);
        } else {
            $this->saveRelationData($page, $relationData);
        }

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

    private function syncRelations($page, array $relationData)
    {
        if (! empty($relationData['metatags']['data'])) {
            $this->syncRelation($this->metatagRepo, $relationData['metatags']['data'],'metatags','page_id', $page->id);
        }

        if (! empty($relationData['comments']['data'])) {
            $this->syncRelation($this->pageCommentRepo, $relationData['comments']['data'],'page-comments','page_id', $page->id);
        }
    }

	public function search($search)
	{
		if (config('services.search.enabled')) {
			return $this->elasticsearchPageRepo->searchWithElasticsearch($search);
		}

		return $this->baseRepo->search($search);
	}
}