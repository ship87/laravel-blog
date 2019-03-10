<?php

namespace App\Traits\Controllers;

use Illuminate\Contracts\Auth\Authenticatable;

trait PolicyTrait
{
    /**
     * PolicyTrait constructor.
     */
    public function __construct()
    {
        $this->setModelPolicy($this->modelPolicy);
    }

    /**
     * @param $modelPolicy
     */
    public function setModelPolicy($modelPolicy)
    {
        if ($modelPolicy) {
            $this->modelPolicy = new $modelPolicy();
        }
    }

    /**
     * @param \Illuminate\Contracts\Auth\Authenticatable $auth
     */
    public function indexPolicy(Authenticatable $auth)
    {
        $check = $auth->can('index', $this->modelPolicy->find(1));
        $this->checkAuthorize($check);
    }

    /**
     * @param \Illuminate\Contracts\Auth\Authenticatable $auth
     */
    public function createPolicy(Authenticatable $auth)
    {
        $check = $auth->can('create', $this->modelPolicy);
        $this->checkAuthorize($check);
    }

    /**
     * @param \Illuminate\Contracts\Auth\Authenticatable $auth
     */
    public function storePolicy(Authenticatable $auth)
    {
        $check = $auth->can('store', $this->modelPolicy);
        $this->checkAuthorize($check);
    }

    /**
     * @param \Illuminate\Contracts\Auth\Authenticatable $auth
     */
    public function editPolicy(Authenticatable $auth)
    {
        $check = $auth->can('edit', $this->modelPolicy->find(1));
        $this->checkAuthorize($check);
    }

    /**
     * @param \Illuminate\Contracts\Auth\Authenticatable $auth
     */
    public function updatePolicy(Authenticatable $auth)
    {
        $check = $auth->can('update', $this->modelPolicy->find(1));
        $this->checkAuthorize($check);
    }

    /**
     * @param \Illuminate\Contracts\Auth\Authenticatable $auth
     */
    public function destroyPolicy(Authenticatable $auth)
    {
        $check = $auth->can('destroy', $this->modelPolicy->find(1));
        $this->checkAuthorize($check);
    }

    /**
     * @param $check
     */
    protected function checkAuthorize($check)
    {
        if (! $check) {
            abort('403', 'Unauthorized action.');
        }
    }
}
