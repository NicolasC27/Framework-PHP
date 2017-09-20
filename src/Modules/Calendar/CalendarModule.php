<?php

/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 13/09/2017
 * Time: 23:46
 */
namespace App\Modules\Calendar;

use App\Modules\Calendar\Actions\CalendarAction;
use Framework\Renderer\RendererInterface;
use Framework\Module;
use Framework\Router;

class CalendarModule extends Module
{
    const DEFINITIONS = __DIR__ . '/config.php';

    const MIGRATIONS =  __DIR__ . '/db/migrations';

    const SEEDS =  __DIR__ . '/db/seeds';

    /**
     * BlogModule constructor.
     * @param string $prefix
     * @param Router $router
     * @param RendererInterface $renderer
     */
    public function __construct(string $prefix, Router $router, RendererInterface $renderer)
    {
        $renderer->addPath('calendar', __DIR__ . '/views');
        $router->get($prefix, CalendarAction::class, 'calendar.index');
    }

}