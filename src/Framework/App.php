<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 9/11/17
 * Time: 2:53 PM
 */
namespace Framework;

use GuzzleHttp\Psr7\Response;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class App
{

    private $modules = [];

    /*
     * Router
     * @var ContainerInterface
     */
    private $container;

    /**
     * App constructor.
     * List modules to load
     * @param ContainerInterface $container
     * @param array $modules
     * @internal param array $dependancies
     */
    public function __construct(ContainerInterface $container, array $modules = [])
    {
        $this->container = $container;
        foreach ($modules as $module) {
            $this->modules[] = $container->get($module);
        }
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws \Exception
     */
    public function run(ServerRequestInterface $request): ResponseInterface
    {
        $uri = $request->getUri()->getPath();
        if (!empty($uri) && $uri[strlen($uri) - 1] === '/') {
            return (new Response())
                ->withStatus(301)
                ->withHeader('Location', substr($uri, 0, strlen($uri) - 1));
        }

        $route = $this->container->get(Router::class)->match($request);
        if (is_null($route)) {
            return new Response(404, [], '<h1>Erreur 404</h1>');
        }

        $params = $route->getParams();

        $request = array_reduce(array_keys($params), function ($request, $key) use ($params) {
            return $request->withAttribute($key, $params[$key]);
        }, $request);

        $callback = $route->getCallback();

        if (is_string($callback))
            $callback = $this->container->get($callback);

        $response = call_user_func_array($callback, [$request]);
        if (is_string($response)) {
            return new Response(200, [], $response);
        } elseif ($response instanceof ResponseInterface) {
            return $response;
        } else {
            throw new \Exception('The response is not a string or an instance 
            of ResponseInterface');
        }
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }

}
