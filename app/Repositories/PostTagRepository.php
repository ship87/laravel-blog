<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\Tag;

class PostTagRepository
{
	protected $modelPost;

	protected $modelTag;

	public function __construct(Post $modelPost, Tag $modelTag)
	{
		$this->modelPost = $modelPost;
		$this->modelTag = $modelTag;
	}

    public function saveMany(Post $post, array $tags)
    {
        return $post->tags()->sync($tags);
    }

}