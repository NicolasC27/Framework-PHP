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
     * @param array $dependancies
     */
    public function __construct(array $modules = [],
                                array $dependancies = [])
    {
        $this->router = new Router();
        if (array_key_exists('renderer', $dependancies)) {
            $dependancies['renderer']->addGlobal('router', $this->router);
        }
        foreach ($modules as $module) {
            $this->modules[] = new $module($this->router,
                $dependancies['renderer']);
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

        $route = $this->router->match($request);
        if (is_null($route)) {
            return new Response(404, [], '<h1>Erreur 404</h1>');
        }

        $params = $route->getParams();
        $request = array_reduce(array_keys($params), function ($request, $key) use ($params) {
            return $request->withAttribute($key, $params[$key]);
        }, $request);

        $response = call_user_func_array($route->getCallback(), [$request]);

        if (is_string($response)) {
            return new Response(200, [], $response);
        } elseif ($response instanceof ResponseInterface) {
            return $response;
        } else {
            throw new \Exception('The response is not a string or an instance 
            of ResponseInterface');
        }
    }
}
