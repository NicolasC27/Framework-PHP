<?php

/**
 * Created by PhpStorm.
 * User: 54735
 * Date: 13/09/2017
 * Time: 23:46
 */

namespace App\Modules\Blog;

use Framework\Router;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BlogModule
{
    public function __construct(Router $router)
    {
        $router->get('/blog', [$this, 'index'], 'blog.index');
        $router->get('/blog/{slug:[a-z\-]+}', [$this, 'show'], 'blog.show');
    }

    public function index(Request $request): string
    {
        return '<h1>Welcome on the blog</h1>';
    }

    public function show(Request $request): string
    {
        return '<h1>Welcome on this article</h1>';
    }

}