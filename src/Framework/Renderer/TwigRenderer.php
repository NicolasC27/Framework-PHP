<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 15/09/2017
 * Time: 23:54
 */

namespace Framework\Renderer;

use Twig_Environment;
use Twig_Loader_Filesystem;

class TwigRenderer implements RendererInterface
{

    private $twig;

    private $loader;

    /**
     * TwigRenderer constructor.
     * @param Twig_Loader_Filesystem $loader
     * @param Twig_Environment $twig
     */
    public function __construct(Twig_Loader_Filesystem $loader, Twig_Environment $twig)
    {
        $this->loader = $loader;
        $this->twig  = $twig;
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