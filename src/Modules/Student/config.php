<?php
/**
 * Created by PhpStorm.
 * User: 54735
 * Date: 16/09/2017
 * Time: 01:07
 */

use App\Modules\Student\StudentModule;
use function \Di\{object, get};

return [
  'student.prefix' => '/student',
    StudentModule::class => object()->constructorParameter('prefix', get('student.prefix'))
];