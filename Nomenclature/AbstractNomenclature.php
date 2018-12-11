<?php
/**
 * Created by PhpStorm.
 * User: darka
 * Date: 07/12/2018
 * Time: 18:54
 */

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