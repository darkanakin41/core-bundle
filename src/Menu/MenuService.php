<?php

/*
 * This file is part of the Darkanakin41CoreBundle package.
 */

namespace Darkanakin41\CoreBundle\Menu;

use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MenuService extends AbstractExtension
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * MenuService constructor.
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getName()
    {
        return 'MenuService';
    }

    public function getFunctions()
    {
        return array(
            new TwigFunction('menu_get', array($this, 'get'), array('is_safe' => array('html'))),
        );
    }

    /**
     * @param $class
     * @param $function
     *
     * @return ItemInterface
     */
    public function get($class, $function)
    {
        $classname = '\\'.str_replace('/', '\\', $class);
        $menu_class = new $classname($this->container, $this->container->get('knp_menu.factory'));
        if (!method_exists($menu_class, $function)) {
            return;
        }

        return call_user_func(array($menu_class, $function));
    }
}
