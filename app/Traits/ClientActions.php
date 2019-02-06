<?php

namespace App\Traits;

trait ClientActions
{
    protected $baseRepo;

    protected $metatagRepo;

    public function getById($id)
    {
        $data = $this->baseRepo->getByParam([
            'id' => $id,
        ]);

        return $data;
    }

    public function getByIdWithSeo($id)
    {
        $data = $this->getById($id);

        $data->seotitle = $this->metatagRepo->getByName($data->metatags, 'title');
        $data->seodescription = $this->metatagRepo->getByName($data->metatags, 'description');
        $data->seokeywords = $this->metatagRepo->getByName($data->metatags, 'keywords');

        return $data;
    }

    public function getPaginated($path)
    {
        $pages = $this->baseRepo->getPaginated($path, config('app.admin_pagination'));

        return $pages;
    }

    public function create(array $data, $auth)
    {
        $data['created_user_id'] = $data['updated_user_id'] = $auth->id;

        $result = $this->baseRepo->create($data);

        return $result;
    }

    public function update(array $data, $id, $auth)
    {
        $data['updated_user_id'] = $auth->id;

        $result = $this->baseRepo->update($data, $id);

        return $result;
    }

    public function destroy(int $id)
    {
        $result = $this->baseRepo->destroy($id);

        return $result;
    }
}