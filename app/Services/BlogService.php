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

    public function getPost($id, $slug)
    {
        $post = $this->postRepo->getPost([
            'id' => $id,
            'slug' => $slug,
        ]);

        return $post;
    }

    public function getPaginated()
    {
        $posts = $this->postRepo->getPaginated(config('app.url_blog'), config('app.blog_pagination'));

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

        //dd(config('app.url_blog').'/archive/'.$way);

        $posts = $this->postRepo->getArchivePostsPaginated(config('app.url_blog').'/archive/'.$way, config('app.blog_pagination'), $year, $month, $day);

        return $this->addUrl($posts);
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