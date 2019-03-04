<?php

namespace App\Traits\Services;

trait ClientPageTrait
{
    protected $baseRepo;

    protected $metatagRepo;

    public function getByParam(array $where, array $with = [], array $orderBy=[])
    {
        return $this->baseRepo->getByParam($where, $with, $orderBy);
    }

    public function getByIdWithSeo($id)
    {
        $data = $this->getByParam(['id' => $id]);

        if (! $data) {
            abort(404);
        }

        $data->seotitle = $this->metatagRepo->getByName($data->metatags, 'title');
        $data->seodescription = $this->metatagRepo->getByName($data->metatags, 'description');
        $data->seokeywords = $this->metatagRepo->getByName($data->metatags, 'keywords');

        return $data;
    }
}