<?php

namespace App\Repositories;

use Elasticsearch\Client;
use App\Models\Page;
use App\Traits\Repositories\ElasticsearchTrait;

class ElasticsearchPageRepository extends PageRepository
{
    use ElasticsearchTrait;

    public function __construct(Page $model, Client $client)
    {
        $this->model = $model;
        $this->search = $client;
        $this->fields = ['title', 'content'];
    }
}