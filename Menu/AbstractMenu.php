<?php

namespace PLejeune\CoreBundle\Menu;


use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

abstract class AbstractMenu
{
    /**
     * @var ContainerInterface
     */
    protected $container;
    /**
     * @var FactoryInterface
     */
    protected $factory;
    /**
     * @var RegistryInterface
     */
    protected $doctrine;

    /**
     * @var RequestStack
     */
    protected $requestStack;
    /**
     * @var \PLejeune\MediaBundle\Service\Slugify
     */
    protected $slugify;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(ContainerInterface $container, FactoryInterface $factory)
    {
        $this->factory = $factory;
        $this->doctrine = $container->get("doctrine");
        $this->requestStack = $container->get("request_stack");
        $this->container = $container;
        $this->slugify = $container->get("plejeune.media.slugify");
    }

    /**
     * Retrieve the first link item
     * @param ItemInterface $item
     * @return ItemInterface
     */
    public static function getFirstLinkItem(ItemInterface $item){
        $childrens = $item->getChildren();
        if(count($childrens) > 0){
            $firstChildren = reset($childrens);
            return self::getFirstLinkItem($firstChildren);
        }
        return $item;
    }
}