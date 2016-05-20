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
      'Nativerank\\Utilities\\' => 'logger',
      'Nativerank\\Logger\\' => 'src'
   ],

    'resources' => [
        'pagekitlogger:' => ''
    ],

    'routes' => [
        '@logger' => [
            'path' => '/logger',
            'controller' => 'Nativerank\\Logger\\Controller\\LoggerController'
        ]
    ],

    'config' => [
        'log_path' => App::getInstance()->offsetGet('path.logs'),
        'created_paths' => [],
        'logger_names' => [],
        'current_paths' => [],
        'index_log_level' => 100,
        'log_date' => true,
        'exclude_logs' => []
    ],

    'menu' => [
        'pagekitlogger' => [
            'label'  => 'Logger',

            // Icon credits:
            // <div>Icons made by <a href="http://www.freepik.com" title="Freepik">Freepik</a> from
            // <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a>
            // is licensed by <a href="http://creativecommons.org/licenses/by/3.0/"
            // title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
            'icon'   =>  'pagekitlogger:log.svg',

            'url'    => '@logger'
        ],
        'pagekitlogger: logs' => [
            'label' => 'Logs',
            'parent' => 'pagekitlogger',
            'url' => '@logger'
        ],
        'pagekitlogger: settings' => [
            'label' => 'Settings',
            'parent' => 'pagekitlogger',
            'url' => '@logger/settings'
        ]
    ],
];