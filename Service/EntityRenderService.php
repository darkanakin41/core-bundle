<?php

namespace PLejeune\CoreBundle\Service;


use Symfony\Component\DependencyInjection\ContainerInterface;

class EntityRenderService extends \Twig_Extension
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
            new \Twig_SimpleFunction('entity_render', [$this, 'render'], ["is_safe" => ["html"]]),
        );
    }

    public function render($entity, $block = "main", $params = [])
    {
        $fullclassname = explode("\\", get_class($entity));
        $classname = strtolower(array_pop($fullclassname));
        try {
            $template = $this->container->get("twig")->load(sprintf("entity/%s.html.twig", $classname));
            return $template->renderBlock($block, array_merge([$classname => $entity], $params));
        } catch (\Twig_Error_Loader $e) {
            return $e->getMessage();
        }
    }

}