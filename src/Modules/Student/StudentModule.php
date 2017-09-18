<?php

/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 13/09/2017
 * Time: 23:46
 */
namespace App\Modules\Student;

use App\Modules\Student\Actions\StudentAction;
use Framework\Renderer\RendererInterface;
use Framework\Module;
use Framework\Router;

class StudentModule extends Module
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
        $renderer->addPath('student', __DIR__ . '/views');
        $router->get($prefix, StudentAction::class, 'student.index');
        $router->get($prefix . '/add', StudentAction::class, 'student.add');
        $router->post($prefix . '/add', StudentAction::class);
    }

}