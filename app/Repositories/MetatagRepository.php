<?php

namespace App\Repositories;

use App\Models\Metatag;

class MetatagRepository extends Repository
{
    public function __construct(Metatag $model)
    {
        $this->model = $model;
    }

    public function getByName($metatags, $name)
    {
        return $metatags->where('name', $name)->first();
    }

    public function saveManyPost($postId, $metatags)
    {
        $this->saveMany('post_id', $postId, $metatags);
    }

    public function saveManyPage($pageId, $metatags)
    {
        $this->saveMany('page_id', $pageId, $metatags);
    }

    private function saveMany($type, $pageId, $metatags)
    {
        foreach ($metatags as $key => $metatag) {

            $saveMetatag = $this->model->firstOrNew([$type => $pageId, 'name' => $key]);
            $saveMetatag->content = $metatag;
            $saveMetatag->save();
        }
    }
}