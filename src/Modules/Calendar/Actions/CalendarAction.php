<?php

/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 16/09/2017
 * Time: 01:29
 */

namespace App\Modules\Calendar\Actions;

use Framework\database\Table;
use Framework\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface as Request;


class CalendarAction
{
    /**
     * @var RendererInterface
     */
    private $renderer;

    /**
     * @var \PDO
     */
    private $pdo;

    /*
     * @var Table
     */
    private $table;

    /**
     * CalendarAction constructor.
     * @param RendererInterface $renderer
     * @param \PDO $pdo
     */
    public function __construct(RendererInterface $renderer, \PDO $pdo)
    {
        $this->renderer = $renderer;
        $this->pdo = $pdo;
        $this->table = new Table($pdo);
    }

    public function __invoke(Request $request)
    {
        return $this->index();
    }

    public function index(): string
    {
        return $this->renderer->render('@calendar/index');
    }
}