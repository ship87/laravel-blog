<?php

namespace App\Traits\Services;

trait CreateUpdateSlugTrait
{
    protected $baseRepo;

    public function create(array $data)
    {
        $data['slug'] = $this->checkSlug($data['slug'], $data['title']);

        return $this->baseRepo->create($data);
    }

    public function update(array $data, $id)
    {


        if (!empty($data['title'])) {
            $data['slug'] = $this->checkSlug(empty($data['slug']) ? false : $data['slug'], $data['title'], $id);
        }



        return $this->baseRepo->update($data, $id);
    }

    protected function checkSlug($slug = false, $title, $id = false)
    {
        if (empty($slug)) {
            $slug = str_slug($title);
        } else {
            $slug = str_slug($slug);
        }

        for ($addNumber = 1; 1; $addNumber++) {

            $check = $this->baseRepo->getByParam(['slug' => $slug], [], [], $id);

            if (empty($check)) {
                if ($addNumber > 1) {
                    $slug = $slug.'-'.$addNumber;
                }
                break;
            }

            $addNumber++;
        }

        return $slug;
    }
}