<?php
/**
 * Created by PhpStorm.
 * User: 54735
 * Date: 15/09/2017
 * Time: 23:54
 */

namespace Framework\Renderer;

class TwigRenderer implements RendererInterface
{

    private $twig;

    private $loader;

    public function __construct(string $path)
    {
        $this->loader = new \Twig_Loader_Filesystem($path);
        $this->twig  = new \Twig_Environment($this->loader, []);
    }

    /**
     * Can added a way to add a view
     * @param string $namespace
     * @param null|string|null $path
     */
    public function addPath(string $namespace, ?string $path = null): void
    {
        $this->loader->addPath($path, $namespace);
    }

    /**
     * Allow to render a view
     * The root/way can be writen with namespaces through addPath()
     * $this->render('@blog/view');
     * $this->render('view');
     * @param string $view
     * @param array $params
     * @return string
     */
    public function render(string $view, array $params = []): string
    {
        return $this->twig->render($view . '.twig', $params);
    }

    /**
     * Allows you to add global variables to all views.
     * @param string $key
     * @param $value
     */
    public function addGlobal(string $key, $value): void
    {
        $this->twig->addGlobal($key, $value);
    }
}