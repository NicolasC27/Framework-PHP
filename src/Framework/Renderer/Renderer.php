<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 14/09/2017
 * Time: 19:49
 */

namespace Framework\Renderer;

class Renderer implements RendererInterface
{

    const DEFAULT_NAMESPACE = '__MAIN';

    private $paths = [];

    /*
     * Global variable accessible to all views
     * @var array
     */
    private $globals = [];

    /**
     * Renderer constructor.
     * @param null|string|null $defaultPath
     */
    public function __construct(?string $defaultPath = null)
    {
        if (!is_null($defaultPath))
            $this->addPath($defaultPath);
    }

    /**
     * Can added a way to add a view
     * @param string $namespace
     * @param null|string|null $path
     */
    public function addPath(string $namespace, ?string $path = null): void
    {
        if (is_null($path))
            $this->paths[self::DEFAULT_NAMESPACE] = $namespace;
        else
            $this->paths[$namespace] = $path;

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
        if ($this->hasNamespace($view)) {
            $path = $this->replaceNamespace($view) . '.php';
        } else {
            $path = $this->paths[self::DEFAULT_NAMESPACE] .
                DIRECTORY_SEPARATOR . $view . '.php';
        }
        ob_start();
        $renderer = $this;
        extract($this->globals);
        extract($params);
        require($path);
        return ob_get_clean();
    }

    /**
     * Allows you to add global variables to all views.
     * @param string $key
     * @param $value
     */
    public function addGlobal(string $key, $value): void
    {
        $this->globals[$key] = $value;
    }

    private function hasNamespace(string $view): bool
    {
        return $view[0] === '@';
    }

    private function getNamespace(string $view): string
    {
        return substr($view, 1, strpos($view, '/') - 1);
    }

    private function replaceNamespace(string $view): string
    {
        $namespace = $this->getNamespace($view);
        return str_replace('@' . $namespace, $this->paths[$namespace], $view);
    }

}