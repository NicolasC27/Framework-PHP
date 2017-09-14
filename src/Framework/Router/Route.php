<?php
namespace Framework\Router;

/*
 * Register and match routes
 */
class Route {

    /**
     * @var string
     */
    private $name;
    /**
     * @var callback
     */
    private $callback;
    /**
     * @var array
     */
    private $parameters;

    /**
     * Route constructor.
     * @param string $name
     * @param callable $callback
     * @param array $parameters
     */
    public function __construct(string $name, callable $callback, array $parameters)
    {

        $this->name = $name;
        $this->callback = $callback;
        $this->parameters = $parameters;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return callable
     */
    public function getCallback(): callable
    {
        return $this->callback;
    }


    /**
     * Retrieve the URL parameters
     * @return string[]
     */
    public function getParams(): array
    {
        return $this->parameters;
    }
}