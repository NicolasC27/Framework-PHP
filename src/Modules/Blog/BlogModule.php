<?php

/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 13/09/2017
 * Time: 23:46
 */
namespace App\Modules\Blog;

use App\Modules\Blog\Actions\BlogAction;
use Framework\Renderer\RendererInterface;
use Framework\Module;
use Framework\Router;

class BlogModule extends Module
{
    const DEFINITIONS = __DIR__ . '/config.php';

    const MIGRATIONS =  __DIR__ . '/db/migrations';

    const SEEDS =  __DIR__ . '/db/seeds';

    /**
     * BlogModule constructor.
     * @param string $prefix
     * @param Router $router
     * @param RendererInterface $renderer
     */
    public function __construct(string $prefix, Router $router, RendererInterface $renderer)
    {
        $renderer->addPath('blog', __DIR__ . '/views');
        $router->get($prefix, BlogAction::class, 'blog.index');
        $router->get($prefix . '/{slug:[a-z\-0-9]+}', BlogAction::class, 'blog.show');    }

}