<?php

/*
 * This file is part of the Darkanakin41CoreBundle package.
 */

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

    public function __construct(ContainerInterface $container, FactoryInterface $factory)
    {
        $this->factory = $factory;
        $this->doctrine = $container->get('doctrine');
        $this->requestStack = $container->get('request_stack');
        $this->container = $container;
        $this->slugify = $container->get('darkanakin41.core.slugify');
        $this->setTranslationDomain('menu');
    }

    /**
     * Retrieve the first link item.
     *
     * @return ItemInterface
     */
    public static function getFirstLinkItem(ItemInterface $item)
    {
        $childrens = $item->getChildren();
        if (count($childrens) > 0) {
            $firstChildren = reset($childrens);

            return self::getFirstLinkItem($firstChildren);
        }

        return $item;
    }

    /**
     * Apply the defined translation domain to all items.
     *
     * @param ItemInterface $item      the item to apply to
     * @param string        $domain    the domain to apply
     * @param bool          $recursive if it must be applied to children or not (default: true)
     */
    protected function applyTranslationDomain(ItemInterface $item, string $domain = 'menu', bool $recursive = true)
    {
        $item->setExtra('translation_domain', $domain);
        if ($recursive) {
            foreach ($item->getChildren() as $child) {
                $this->applyTranslationDomain($child, $domain, $recursive);
            }
        }
    }
}
