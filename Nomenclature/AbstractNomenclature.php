<?php

namespace PLejeune\CoreBundle\Nomenclature;

use ReflectionClass;

abstract class AbstractNomenclature
{
    public static function getAllConstants(){
        try {
            $reflectionClass = new ReflectionClass(get_called_class());
            return $reflectionClass->getConstants();
        } catch (\ReflectionException $e) {
            return [];
        }
    }
}