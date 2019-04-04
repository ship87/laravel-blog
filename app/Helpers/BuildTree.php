<?php

namespace App\Helpers;

class BuildTree
{
    protected $data;

    public function __construct($data)
    {
        $this->setData($data);
    }

	/**
	 * @return mixed
	 */
	public function getData() {

		return $this->data;
	}

	/**
	 * @param mixed $data
	 */
	public function setData($data) {

		$this->data = $data;

		return $this;
	}


	public function getTree()
    {
    	$data=$this->getData();

    	$tree=$this->getBranch($data);


		///dd($tree);

        return $tree;
    }

    private function getBranch(&$data, $parentId = 0)
    {
        $tree = [];

        foreach ($data as $id => $node) {

            if ((int) $node->parent_id == $parentId) {
                unset($data[$id]);
                $node->childs = $this->getBranch($data, $node->id);
                $tree[] = $node;
            }
        }

        return $tree;
    }
}