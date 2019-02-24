<?php

namespace App\Traits;

trait CreateUpdateUserTrait
{
	protected $baseRepo;

	public function create(array $data, $authId)
	{
		$data['created_user_id'] = $data['updated_user_id'] = $authId;

		return $this->baseRepo->create($data);
	}

	public function update(array $data, $id, $authId)
	{
		$data['updated_user_id'] = $authId;

		return $this->baseRepo->update($data, $id);
	}

}