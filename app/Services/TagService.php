<?php

namespace App\Services;

use App\Repositories\TagRepository;

class TagService
{
	protected $tagRepo;

	public function __construct(TagRepository $tagRepo)
	{
		$this->tagRepo = $tagRepo;
	}

    public function show($id)
    {
        $result = $this->tagRepo->show($id);

        return $result;
    }

	public function getPaginated($path)
	{
		$categories = $this->tagRepo->getPaginated($path, config('app.admin_pagination'));

		return $categories;
	}

	public function create(array $data)
	{
		$result = $this->tagRepo->create($data);

		return $result;
	}

	public function update(array $data, $id)
	{
		$result = $this->tagRepo->update($data, $id);

		return $result;
	}

	public function destroy(int $id)
	{
		$result = $this->tagRepo->destroy($id);

		return $result;
	}
}