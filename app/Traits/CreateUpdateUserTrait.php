<?php

namespace App\Traits;

trait CreateUpdateUserTrait
{
	protected $baseRepo;

	public function create(array $data, $auth)
	{
		$data['created_user_id'] = $data['updated_user_id'] = $auth->id;

		return $this->baseRepo->create($data);
	}

	public function update(array $data, $id, $auth)
	{
		$data['updated_user_id'] = $auth->id;

		return $this->baseRepo->update($data, $id);
	}

}