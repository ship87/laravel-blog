<?php

namespace App\Traits;

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
		$data['slug'] = $this->checkSlug($data['slug'], $data['title']);

		return $this->baseRepo->update($data, $id);
	}

	protected function checkSlug($slug, $title) {



		if (empty($slug)){
			$slug = str_slug($title);



		} else {
			$slug = str_slug($slug);
		}



		$addNumber = 2;
		do {
			$check = $this->baseRepo->getByParam(['slug' => $slug]);

			//dd($slug->isEmpty());

			$slug = $slug . '-' . $addNumber;
			$addNumber++;

			//dd($slug);

		} while (!empty($check));

		return $slug;
	}

}