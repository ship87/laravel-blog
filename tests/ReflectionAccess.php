<?php

namespace Tests;

use ReflectionClass;

trait ReflectionAccess
{
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
        $reflection = new ReflectionClass($object);
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
        $reflection = new ReflectionClass($object);
        $reflection_property = $reflection->getProperty($property);
        $reflection_property->setAccessible(true);

        return $reflection_property->getValue($object);
    }
}
