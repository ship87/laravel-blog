<?php

namespace App\Traits;

trait CreateUpdateTrait
{
	protected $baseRepo;

	public function create(array $data)
	{
		return $this->baseRepo->create($data);
	}

	public function update(array $data, $id)
	{
		return $this->baseRepo->update($data, $id);
	}

}