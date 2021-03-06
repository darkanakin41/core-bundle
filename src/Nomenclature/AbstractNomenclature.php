<?php

/*
 * This file is part of the Darkanakin41CoreBundle package.
 */

namespace Darkanakin41\CoreBundle\Nomenclature;

use ReflectionClass;

abstract class AbstractNomenclature
{
    public static function getAllConstants()
    {
        try {
            $reflectionClass = new ReflectionClass(get_called_class());

            return $reflectionClass->getConstants();
        } catch (\ReflectionException $e) {
            return array();
        }
    }
}
