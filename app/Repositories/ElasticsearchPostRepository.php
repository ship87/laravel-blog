<?php

namespace App\Repositories;

use Elasticsearch\Client;
use App\Models\Post;
use App\Traits\Repositories\ElasticsearchTrait;

class ElasticsearchPostRepository extends PostRepository
{
    use ElasticsearchTrait;

    public function __construct(Post $model, Client $client)
    {
        $this->model = $model;
        $this->search = $client;
        $this->fields = ['title', 'content'];
    }
}