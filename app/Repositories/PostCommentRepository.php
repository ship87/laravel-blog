<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

use App\Models\PostComment;

class PostCommentRepository extends Repository
{
    protected $table;

    public function __construct(PostComment $model)
    {
        $this->model = $model;
    }

    public function getWithUrl($count = false)
    {
        $result = DB::table('post_comments');

        $result->join('posts', 'posts.id', '=', 'post_comments.post_id');
        $result->join('users', 'users.id', '=', 'post_comments.created_user_id');
        $result->select('post_comments.*', 'posts.slug as post_slug', 'users.name as created_user');

        if ($count) {
            $result->limit($count);
        }

        return $result->get();
    }
}