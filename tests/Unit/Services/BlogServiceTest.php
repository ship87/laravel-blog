<?php

namespace Tests\Unit\Services;

use Tests\TestCase;

use Elasticsearch\Client;
use App\Services\BlogService;
use App\Repositories\PostRepository;

class BlogServiceTest extends TestCase
{
    protected $postRepo;

    protected $elasticsearchPostRepo;

    protected $blogService;

    protected function setUp()
    {
        parent::setUp();

        $this->postRepo = $this->getMockBuilder(PostRepository::class)->disableOriginalConstructor()->getMock();

        $this->elasticsearchPostRepo = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();

        $this->blogService = $this->getMockBuilder(BlogService::class)->disableOriginalConstructor()->getMock();


        $this->setProtectedProperty($this->blogService,'postRepo', $this->postRepo);
        $this->setProtectedProperty($this->blogService,'elasticsearchPostRepo', $this->elasticsearchPostRepo);


    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /**
     * Set protected property on a given object via reflection
     *
     * @param $object
     * @param $property
     * @param $value
     * @throws \ReflectionException
     */
    public function setProtectedProperty($object, $property, $value)
    {
        $reflection = new \ReflectionClass($object);
        $reflection_property = $reflection->getProperty($property);
        $reflection_property->setAccessible(true);
        $reflection_property->setValue($object, $value);
    }

    /**
     * Get protected property on a given object via reflection
     *
     * @param $object
     * @param $property
     * @param $value
     * @throws \ReflectionException
     */
    public function getProtectedProperty($object, $property)
    {
        $reflection = new \ReflectionClass($object);
        $reflection_property = $reflection->getProperty($property);
        $reflection_property->setAccessible(true);
        $reflection_property->getValue($object);
    }
}
