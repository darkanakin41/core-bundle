<?php

namespace Darkanakin41\CoreBundle\Extension;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class DateService extends AbstractExtension
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
            new TwigFunction('date_intl_format', array($this, 'format')),
            new TwigFunction('date_age', array($this, 'age')),
            new TwigFunction('date_horodatage', array($this, 'horodatage')),
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
