<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 16/09/2017
 * Time: 00:37
 */

namespace Framework\Renderer;

use Interop\Container\ContainerInterface;
use Twig_Environment;
use Twig_Loader_Filesystem;

class TwigRendererFactory
{
    /**
     * @param ContainerInterface $container
     * @return TwigRenderer
     */
    public function __invoke(ContainerInterface $container): TwigRenderer
    {
        $viewPath = $container->get('views.path');
        $loader = new Twig_Loader_Filesystem($viewPath);
        $twig = new Twig_Environment($loader);

        if ($container->has('twig.extensions')) {
            foreach ($container->get('twig.extensions') as $extension) {
                $twig->addExtension($extension);
            }
        }
        return new TwigRenderer($loader, $twig);
    }
}