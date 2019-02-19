<?php

namespace App\Traits;

trait ClientPageTrait
{
    protected $baseRepo;

    protected $metatagRepo;

    public function getByParam(array $where, array $with = [])
    {
        return $this->baseRepo->getByParam($where, $with);
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