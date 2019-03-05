<?php

namespace App\Traits\Controllers;

use Illuminate\Contracts\Auth\Authenticatable;

trait PolicyTrait {

	protected $currentUser;

	public function __construct() {
		$this->setModelPolicy($this->modelPolicy);
	}

	public function setModelPolicy($modelPolicy) {
		if ($modelPolicy) {
			$this->modelPolicy = new $modelPolicy();
		}
	}


	public function indexPolicy(Authenticatable $auth) {
		$check = $auth->can('index', $this->modelPolicy->find(1));
		$this->checkAuthorize($check);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function createPolicy() {
		$check = $this->currentUser->can('create', $this->modelPolicy);
		$this->checkAuthorize($check);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function storePolicy() {
		$check = $this->currentUser->can('store', $this->modelPolicy);
		$this->checkAuthorize($check);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function editPolicy() {
		$check = $this->currentUser->can('edit', $this->modelPolicy->find(1));
		$this->checkAuthorize($check);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int                      $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function updatePolicy() {
		$check = $this->currentUser->can('update', $this->modelPolicy->find(1));
		$this->checkAuthorize($check);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroyPolicy() {
		$check = $this->currentUser->can('destroy', $this->modelPolicy->find(1));
		$this->checkAuthorize($check);
	}

	protected function checkAuthorize($check){
		if (!$check) {
			abort('403', 'Unauthorized action.');
		}
	}
}
