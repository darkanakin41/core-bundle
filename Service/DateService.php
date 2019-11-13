<?php

namespace Darkanakin41\CoreBundle\Service;

class DateService extends \Twig_Extension
{

    public static function format(\DateTime $date, $format)
    {
        setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
        return strftime($format, $date->getTimestamp());
    }

    public function age(\DateTime $date = NULL)
    {
        if (is_null($date)) {
            return "N/A";
        }
        $date_interval = $date->diff(new \DateTime());

        return $date_interval->y;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('date_intl_format', array($this, 'format')),
            new \Twig_SimpleFunction('date_age', array($this, 'age')),
            new \Twig_SimpleFunction('date_horodatage', array($this, 'horodatage')),
        );
    }

    public function horodatage(\DateTime $date, $full = 'd/m/Y \à H:i')
    {
        $now = new \DateTime("now");
        if ($date->format("Y-m-d") == $now->format("Y-m-d")) {
            return $date->format("H:i");
        }
        return $date->format($full);
    }

    public function getName()
    {
        return 'DateService';
    }
}
