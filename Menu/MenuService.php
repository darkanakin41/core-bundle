<?php
namespace Darkanakin41\CoreBundle\Menu;


use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MenuService extends \Twig_Extension
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * MenuService constructor.
     * @param ContainerInterface $container
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
            new \Twig_SimpleFunction('menu_get', array($this, 'get'), array("is_safe" => array("html"))),
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
        $classname = "\\" . str_replace("/", "\\", $class);
        $menu_class = new $classname($this->container, $this->container->get("knp_menu.factory"));
        if (!method_exists($menu_class, $function)) {
            return;
        }
        return call_user_func(array($menu_class, $function));
    }
}
