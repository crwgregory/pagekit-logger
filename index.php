<?php
/**
 * Created by PhpStorm.
 * User: crwgr
 * Date: 4/8/2016
 * Time: 11:45 AM
 */

use Pagekit\Application as App;
use Nativerank\Utilities\PagekitLogger as Logger;

return [

   'name' => 'pagekit-logger',

   'type' => 'extension',

   'main' => function (App $app) {
      $app['logger'] = function() {
        return new Logger();
      };
   },

   'autoload' => [
      'Nativerank\\Utilities\\' => 'src'
   ]
];