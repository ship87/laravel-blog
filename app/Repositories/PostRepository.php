<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

use Elasticsearch\Client;
use App\Models\Post;

class PostRepository extends Repository
{
    protected $search;

    public function __construct(Post $model, Client $client)
    {
        $this->model = $model;
        $this->search = $client;
    }

    public function getByParamAll(array $where = [])
    {
        return $this->model->with([
            'comments',
            'metatags',
            'tags',
            'categories',
            'createdUser',
            'updatedUser',
        ])->where($where)->first();
    }

    public function getCategoryPostsPaginated($path, $count, $category)
    {
        return $this->model->whereHas('categories', function ($q) use ($category) {
            $q->where('slug', $category);
        })->paginate($count)->setPath($path);
    }

    public function getArchivePostsPaginated($path, $count, $year, $month = false, $day = false)
    {
        $startTime = '00:00:00';
        $endTime = '23:59:59';

        $startDate = $year.'-01-01 '.$startTime;
        $endDate = $year.'-12-31 '.$endTime;

        if ($day && $month) {

            $startDate = $year.'-'.$month.'-'.$day.' '.$startTime;
            $endDate = $year.'-'.$month.'-'.$day.' '.$endTime;
        } elseif ($month) {

            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $startDate = $year.'-'.$month.'-01 '.$startTime;
            $endDate = $year.'-'.$month.'-'.$daysInMonth.' '.$endTime;
        }

        return $this->model->whereBetween('created_at', [$startDate, $endDate])->paginate($count)->setPath($path);
    }

    public function search(string $query = ""): Collection
    {
        return $this->model->where('content', 'like', "%{$query}%")->orWhere('title', 'like', "%{$query}%")->get();
    }

    public function searchWithElasticsearch(string $query = ""): Collection
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
                        'fields' => ['title', 'content'],
                        'query' => $query,
                    ],
                ],
            ],
        ]);

        return $items;
    }

    private function buildCollectionElasticsearch(array $items): Collection
    {
        $hits = array_pluck($items['hits']['hits'], '_source') ?: [];

        $sources = array_map(function ($source) {
            $source['title'] = json_encode($source['title']);
            $source['content'] = json_encode($source['content']);
            return $source;
        }, $hits);

        return $this->model->hydrate($sources);
    }

}