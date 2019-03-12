<?php

namespace App\Services;

use App\Repositories\PostRepository;

class BlogService
{
    protected $postRepo;

    public function __construct(PostRepository $postRepo)
    {
        $this->postRepo = $postRepo;
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
        if (env('SEARCH_ENABLED')) {
            return $this->postRepo->searchWithElasticsearch($search);
        }

        return $this->postRepo->search($search);
    }

    private function addUrl($posts)
    {

        if (! empty($posts)) {
            foreach ($posts as $key => $post) {
                $posts[$key]->url = config('app.url_blog').'/'.$post->id.'/'.$post->slug;
            }
        }

        return $posts;
    }
}