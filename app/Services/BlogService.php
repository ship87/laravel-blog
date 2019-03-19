<?php

namespace App\Services;

use App\Repositories\PostRepository;
use App\Repositories\ElasticsearchPostRepository;

class BlogService
{
    protected $postRepo;

    protected $elasticsearchPostRepo;

    public function __construct(PostRepository $postRepo, ElasticsearchPostRepository $elasticsearchPostRepo)
    {
        $this->postRepo = $postRepo;
        $this->elasticsearchPostRepo = $elasticsearchPostRepo;
    }

    public function getByIdSlug($id, $slug)
    {
        $post = $this->postRepo->getByParam([
            'id' => $id,
            'slug' => $slug,
        ]);

        return $post;
    }

    public function getPaginated()
    {
        $posts = $this->postRepo->getPaginated(config('app.url_blog'), false, config('app.blog_pagination'));

        return $this->addUrl($posts);
    }

    public function getCategoryPostsPaginated($category)
    {
        $posts = $this->postRepo->getCategoryPostsPaginated(config('app.url_blog').'/category/'.$category, config('app.blog_pagination'), $category);

        return $this->addUrl($posts);
    }

    public function getArchivePostsPaginated($year, $month = false, $day = false)
    {
        $way = $year;

        if ($day && $month) {

            $way = $year.'/'.$month.'/'.$day;
        } elseif ($month) {

            $way = $year.'/'.$month;
        }

        $posts = $this->postRepo->getArchivePostsPaginated(config('app.url_blog').'/archive/'.$way, config('app.blog_pagination'), $year, $month, $day);

        return $this->addUrl($posts);
    }

    public function search($search)
    {
        if (config('services.search.enabled')) {

            $posts = $this->elasticsearchPostRepo->searchWithElasticsearch($search);

            $posts = $this->postRepo->paginate($posts, config('app.blog_pagination'), null, ['path' => config('app.url_blog').'?search='.$search]);
        } else {
            $posts = $this->postRepo->search($search);
        }

        return $posts;
    }

    public function addUrl($posts)
    {
        if (! empty($posts)) {
            foreach ($posts as $key => $post) {
                $posts[$key]->url = config('app.url_blog').'/'.$post->id.'/'.$post->slug;
            }
        }

        return $posts;
    }
}