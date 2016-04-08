<?php
/**
 * Created by PhpStorm.
 * User: crwgr
 * Date: 4/8/2016
 * Time: 11:45 AM
 */

use Nativerank\Utilities\PagekitLogger as Logger;

return [

   'name' => 'Pagekit Logger',

   'type' => 'extension',

   'main' => function (App $app) {
      $app['logger'] = function($name = '') {
        return new Logger($name);
      };
   },

   'autoload' => [
      'Nativerank\\Utilities\\' => 'src'
   ]
];