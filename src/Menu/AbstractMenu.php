<?php

namespace Darkanakin41\CoreBundle\Menu;


use Darkanakin41\CoreBundle\Service\SlugifyService;
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
     * @var SlugifyService
     */
    protected $slugify;

    /**
     * @var string
     */
    private $translationDomain;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(ContainerInterface $container, FactoryInterface $factory)
    {
        $this->factory = $factory;
        $this->doctrine = $container->get("doctrine");
        $this->requestStack = $container->get("request_stack");
        $this->container = $container;
        $this->slugify = $container->get("darkanakin41.core.slugify");
        $this->setTranslationDomain('menu');
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

    /**
     * Set the translation domain to apply in applyTranslationDomain(ItemInterface $item)
     * @param string $domain the domain to apply
     */
    protected function setTranslationDomain(string $domain){
        $this->translationDomain = $domain;
    }

    /**
     * Apply the defined translation domain to all items
     *
     * @param ItemInterface $item the item to apply to
     * @param bool $recursive if it must be applied to children or not (default: true)
     */
    protected function applyTranslationDomain(ItemInterface $item, bool $recursive = true){
        $item->setExtra("translation_domain", "menu");
        if($recursive){
            foreach($item->getChildren() as $child){
                $this->applyTranslationDomain($child);
            }
        }
    }
}
