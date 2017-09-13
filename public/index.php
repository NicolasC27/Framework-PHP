<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 9/11/17
 * Time: 2:47 PM
 */

require '../vendor/autoload.php';

$app = new \Framework\App([
    \App\Modules\Blog\BlogModule::class
]);
$response = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());
\Http\Response\send($response);
