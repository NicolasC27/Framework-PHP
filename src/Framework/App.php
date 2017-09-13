<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 9/11/17
 * Time: 2:53 PM
 */
namespace Framework;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class App
{

    private $modules = [];

    /**
     * Router
     * @var Router
     */
    private $router;

    /**
     * App constructor.
     * List modules to load
     * @param array $modules
     */
    public function __construct(array $modules = [])
    {
        $this->router = new Router();
        foreach ($modules as $module) {
            $this->modules = new $module();
        }
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function run(ServerRequestInterface $request) : ResponseInterface
    {
        $uri = $request->getUri()->getPath();
        if (!empty($uri) && $uri[strlen($uri) - 1] === '/') {
            return (new Response())
                ->withStatus(301)
                ->withHeader('Location', substr($uri, 0, strlen($uri) - 1));
        }

        if ($uri === '/blog') {
            return (new Response(200, [], '<h1>Bienvenue sur le blog</h1>'));
        }

        return new Response(404, [], '<h1>Erreur 404</h1>');
    }
}
