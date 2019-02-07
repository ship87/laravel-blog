<?php

namespace App\Traits;

trait ClientPageTrait
{
    protected $baseRepo;

    protected $metatagRepo;

    public function getByParam($id)
    {
        return $this->baseRepo->getByParam(['id' => $id]);
    }

    public function getByIdWithSeo($id)
    {
        $data = $this->getByParam($id);

        if (! $data) {
            return false;
        }

        $data->seotitle = $this->metatagRepo->getByName($data->metatags, 'title');
        $data->seodescription = $this->metatagRepo->getByName($data->metatags, 'description');
        $data->seokeywords = $this->metatagRepo->getByName($data->metatags, 'keywords');

        return $data;
    }
}