<?php

/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 16/09/2017
 * Time: 01:29
 */

namespace App\Modules\Blog\Actions;

use Framework\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface as Request;


class BlogAction
{
    /**
     * @var RendererInterface
     */
    private $renderer;

    /**
     * BlogAction constructor.
     * @param RendererInterface $renderer
     */
    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function __invoke(Request $request)
    {
        $slug = $request->getAttribute('slug');
        return $slug ? $this->show($slug) : $this->index();
    }

    public function index(): string
    {

        return $this->renderer->render('@blog/index');
    }

    public function show(string $slug): string
    {
        return $this->renderer->render('@blog/show', [
            'slug' => $slug
        ]);
    }
}