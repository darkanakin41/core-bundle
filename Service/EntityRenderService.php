<?php

namespace Darkanakin41\CoreBundle\Service;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig\Error\LoaderError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class EntityRenderService extends AbstractExtension
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getName()
    {
        return 'EntityRenderService';
    }

    public function getFunctions()
    {
        return array(
            new TwigFunction('entity_render', [$this, 'render'], ["is_safe" => ["html"]]),
        );
    }

    public function render($entity, $block = "main", $params = [])
    {
        $fullclassname = explode("\\", get_class($entity));
        $classname = strtolower(array_pop($fullclassname));
        try {
            $template = $this->container->get("twig")->load(sprintf("entity/%s.html.twig", $classname));
            return $template->renderBlock($block, array_merge([$classname => $entity], $params));
        } catch (LoaderError $e) {
            return $e->getMessage();
        }
    }

}
