<?php

namespace App\Services;

use App\Repositories\CategoryPostRepository;
use App\Repositories\PostRepository;
use App\Repositories\MetatagRepository;
use App\Repositories\PostTagRepository;
use App\Traits\Services\AdminPageTrait;
use App\Traits\Services\ClientPageTrait;
use App\Traits\Services\CreateUpdateSlugTrait;
use App\Traits\Services\IncludeRelateResourceTrait;
use App\Traits\Services\FilterDataTrait;
use App\Traits\Services\MergeNewDataTrait;
use App\Traits\Services\SortDataTrait;

class PostService
{
    use AdminPageTrait, ClientPageTrait, CreateUpdateSlugTrait, IncludeRelateResourceTrait, FilterDataTrait, SortDataTrait, MergeNewDataTrait;

    protected $relatedResources = [
        'comments' => '\\App\\Http\\Resources\\PageComment\\PageCommentResource',
        'metatags' => '\\App\\Http\\Resources\\Metatag\\MetatagResource',
        'tags' => '\\App\\Http\\Resources\\Tag\\TagResource',
        'categories' => '\\App\\Http\\Resources\\Category\\CategoryResource',
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

    protected $categoryPostRepo;

    protected $postTagRepo;

    public function __construct(
        PostRepository $postRepo,
        MetatagRepository $metatagRepo,
        CategoryPostRepository $categoryPostRepo,
        PostTagRepository $postTagRepo
    ) {
        $this->baseRepo = $postRepo;
        $this->metatagRepo = $metatagRepo;
        $this->categoryPostRepo = $categoryPostRepo;
        $this->postTagRepo = $postTagRepo;
    }

    public function update(array $data, array $relationData, $id, $authId)
    {
        $data['updated_user_id'] = $authId;
        $data['slug'] = $this->checkSlug($data['slug'], $data['title'], $id);

        $post = $this->baseRepo->update($data, $id);

        if (! $post) {
            return false;
        }

        $this->saveRelationData($post, $relationData);

        return $post;
    }

    public function create(array $data, array $relationData, $authId)
    {
        $data['created_user_id'] = $data['updated_user_id'] = $authId;
        $data['slug'] = $this->checkSlug($data['slug'], $data['title']);

        $post = $this->baseRepo->create($data);

        if (! $post) {
            return false;
        }

        $this->saveRelationData($post, $relationData);

        return $post;
    }

    private function saveRelationData($post, array $relationData)
    {
        $this->metatagRepo->saveManyPost($post->id, [
            'title' => $relationData['seotitle'],
            'description' => $relationData['seodescription'],
            'keywords' => $relationData['seokeywords'],
        ]);

        $categories = [];
        if (! empty($relationData['categories']) && is_array($relationData['categories'])) {
            $categories = array_values($relationData['categories']);
        }

        $this->categoryPostRepo->saveMany($post, $categories);

        $tags = [];
        if (! empty($relationData['tags']) && is_array($relationData['tags'])) {
            $tags = array_values($relationData['tags']);
        }

        $this->postTagRepo->saveMany($post, $tags);
    }
}