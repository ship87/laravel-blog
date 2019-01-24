<?php

namespace App\Helpers;

class BuildTree
{
	protected $data;

	public $childs;

	public function __construct($data)
	{
		$this->data = $data;
	}

	public function getTree()
	{
		return $this->getBranch($this->data);
	}

	private function getBranch(&$data, $parentId = 0)
	{
		$tree = [];

		foreach ($data as $id => $node) {
			if (is_null($node->parent_id)||(int)$node->parent_id == $parentId) {
				unset($data[$id]);
				$node->childs = $this->getBranch($data, $node->id);
				$tree[] = $node;
			}
		}
		return $tree;
	}

}