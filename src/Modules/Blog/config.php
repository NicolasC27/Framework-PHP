<?php
/**
 * Created by PhpStorm.
 * User: 54735
 * Date: 16/09/2017
 * Time: 01:07
 */

use App\Modules\Blog\BlogModule;
use function \Di\{object, get};

return [
  'blog.prefix' => '/blog',
    BlogModule::class => object()->constructorParameter('prefix', get('blog.prefix'))
];