<?php

namespace Darkanakin41\CoreBundle\Service;

use Darkanakin41\CoreBundle\Tools\Slugify as ProcessClass;

class Slugify extends \Twig_Extension
{

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('slugify', array($this, 'slugify')),
        );
    }

    public function getName()
    {
        return 'SlugifyService';
    }

    public function slugify($text)
    {
        return ProcessClass::process($text);
    }

}
