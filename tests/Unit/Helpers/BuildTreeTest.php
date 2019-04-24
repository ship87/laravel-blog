<?php

namespace Tests\Unit\Helpers;

use Tests\TestCase;

use App\Helpers\BuildTree;

class BuildTreeTest extends TestCase
{
    protected $mockData;

    protected $resultTreeData;

    protected function setUp()
    {

        parent::setUp();

        $mockModelFirst = $this->getMockBuilder('Category')->getMock();

        $mockModelFirst->id = 1;
        $mockModelFirst->parent_id = null;

        $mockModelSecond = $this->getMockBuilder('Category')->getMock();

        $mockModelSecond->id = 2;
        $mockModelSecond->parent_id = 1;

        $this->mockData = [$mockModelFirst, $mockModelSecond];

        $resultTreeData = $mockModelFirst;
        $resultTreeData->childs = $mockModelSecond;
        $this->resultTreeData = $resultTreeData;
    }

    public function testGetTree()
    {
        $buildTree = (new BuildTree($this->mockData))->getTree();
        $buildTree = array_shift($buildTree);

        $this->assertEquals($buildTree, $this->resultTreeData);
    }
}
