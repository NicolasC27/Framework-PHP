<?php

use Framework\Renderer\RendererInterface;
use Framework\Renderer\TwigRendererFactory;
use Framework\Router;
use Framework\Router\RouterTwigExtension;

return [
    'views.path' => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views',
    'twig.extensions' => [
        \DI\get(RouterTwigExtension::class)
    ],
    Router::class => \DI\object(),
    RendererInterface::class => \DI\factory(TwigRendererFactory::class)
];