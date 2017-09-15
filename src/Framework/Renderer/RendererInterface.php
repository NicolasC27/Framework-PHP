<?php
/**
 * Created by PhpStorm.
 * User: 54735
 * Date: 15/09/2017
 * Time: 22:19
 */
namespace Framework\Renderer;

interface RendererInterface
{
    /**
     * Can added a way to add a view
     * @param string $namespace
     * @param null|string|null $path
     */
    public function addPath(string $namespace, ?string $path = null): void;

    /**
     * Allow to render a view
     * The root/way can be writen with namespaces through addPath()
     * $this->render('@blog/view');
     * $this->render('view');
     * @param string $view
     * @param array $params
     * @return string
     */
    public function render(string $view, array $params = []): string;

    /**
     * Allows you to add global variables to all views.
     * @param string $key
     * @param $value
     */
    public function addGlobal(string $key, $value): void;
}