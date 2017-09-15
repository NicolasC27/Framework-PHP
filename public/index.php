<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 9/11/17
 * Time: 2:47 PM
 */

require '../vendor/autoload.php';

$renderer = new \Framework\Renderer\TwigRenderer(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views');

$app = new \Framework\App(
    [
        \App\Modules\Blog\BlogModule::class
    ],
    [
        'renderer' => $renderer]);
$response = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());
\Http\Response\send($response);
