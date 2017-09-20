<?php
/**
 * Created by PhpStorm.
 * User: 54735
 * Date: 16/09/2017
 * Time: 01:07
 */

use App\Modules\Calendar\CalendarModule;
use function \Di\{object, get};

return [
  'calendar.prefix' => '/calendar',
    CalendarModule::class => object()->constructorParameter('prefix', get('calendar.prefix'))
];