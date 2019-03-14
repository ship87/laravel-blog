<?php

namespace App\Traits\Repositories;

trait ElasticsearchTrait
{
    protected $search;

    protected $fields = [];

    public function searchWithElasticsearch(string $query = "")
    {
        $items = $this->searchOnElasticsearch($query);

        return $this->buildCollectionElasticsearch($items);
    }

    private function searchOnElasticsearch(string $query): array
    {
        $items = $this->search->search([
            'index' => $this->model->getSearchIndex(),
            'type' => $this->model->getSearchType(),
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => $this->fields,
                        'query' => $query,
                    ],
                ],
            ],
        ]);

        return $items;
    }

    private function buildCollectionElasticsearch(array $items)
    {

        $hits = array_pluck($items['hits']['hits'], '_source') ?: [];

        $collection = $this->model->hydrate($hits);

        return $collection;
    }
}