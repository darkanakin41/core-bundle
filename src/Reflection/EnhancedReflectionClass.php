<?php


namespace Darkanakin41\CoreBundle\Reflection;


use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

class EnhancedReflectionClass extends ReflectionClass
{
    /**
     * @inheritDoc
     * @return ReflectionProperty[]
     * @throws ReflectionException
     */
    public function getProperties($filter = null)
    {
        $properties = parent::getProperties($filter);
        $parent = $this->getParentClass();
        if (false !== $parent) {
            $parentObject = new self($parent);
            $properties = array_merge($properties, $parentObject->getProperties($filter));
        }
        return $properties;
    }
}