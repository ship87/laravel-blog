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

    public function getPostsPaginated()
    {

        $posts = $this->postRepo->getPostsPaginated(config('app.url_blog'), config('app.blog_post_pagination'));

        foreach ($posts as $key => $post) {
            $posts[$key]->url = config('app.url_blog').'/'.$post->id.'/'.$post->slug;
        }

        return $posts;
    }

	public function getCategoryPostsPaginated($category)
	{

		$posts = $this->postRepo->getCategoryPostsPaginated(config('app.url_blog').'/category/'.$category, config('app.blog_post_pagination'),$category);

		foreach ($posts as $key => $post) {
			$posts[$key]->url = config('app.url_blog').'/'.$post->id.'/'.$post->slug;
		}

		return $posts;
	}
}