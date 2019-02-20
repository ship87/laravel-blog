<?php

namespace App\Services;

use App\Repositories\CategoryPostRepository;
use App\Repositories\PostRepository;
use App\Repositories\MetatagRepository;

use App\Repositories\PostTagRepository;
use App\Traits\AdminPageTrait;
use App\Traits\ClientPageTrait;
use App\Traits\CreateUpdateSlugTrait;
use App\Traits\IncludeRelateResourceTrait;
use App\Traits\FilterDataTrait;
use App\Traits\SortDataTrait;

class PostService
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

    public function update(array $data, array $relationData, $id, $auth)
    {
        $data['updated_user_id'] = $auth->id;
        $data['slug'] = $this->checkSlug($data['slug'], $data['title']);

        $post = $this->baseRepo->update($data, $id);

        if (! $post) {
            return false;
        }

        $this->saveRelationData($post, $relationData);

        return $post;
    }

    public function create(array $data, array $relationData, $auth)
    {
        $data['created_user_id'] = $data['updated_user_id'] = $auth->id;
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

        if (! empty($relationData['categories'])) {
            $this->categoryPostRepo->saveMany($post, array_values($relationData['categories']));
        }

        if (! empty($relationData['categories'])) {
            $this->postTagRepo->saveMany($post, array_values($relationData['tags']));
        }
    }
}