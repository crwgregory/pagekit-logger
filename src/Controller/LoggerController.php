<?php
/**
 * Created by PhpStorm.
 * User: crwgr
 * Date: 5/12/2016
 * Time: 1:17 PM
 */

namespace Nativerank\Logger\Controller;

use Pagekit\Application as App;

use Nativerank\Utilities\PagekitLogger;

/**
 * Class LoggerController
 * @package Nativerank\Logger\Controller
 * @access(admin=true)
 */
class LoggerController
{
    /**
     * @Route("/")
     * @Method("GET")
     */
    function indexAction()
    {
//        $e = new App\Exception('hello');
//        $logger = new PagekitLogger();
//        $logger->logException($e);

        $currentPaths = App::module('pagekit-logger')->config('current_paths');

        $currentNames = App::module('pagekit-logger')->config('logger_names');

        $data = [];

        foreach ($currentPaths as $path) {

            $handle = fopen($path, 'r');

            if ($handle) {

                while (($line = fgets($handle)) !== false) {

                    foreach ($currentNames as $loggerName) {
                        if (($pos = strpos($line, $loggerName)) !== false) {

                            if ( !array_key_exists($loggerName, $data) ) {
                                $data[$loggerName] = [];
                            }
                            $message = [];
                            $message['date'] = substr($line, 1, 19);

                            $x = substr($line, ($pos + strlen($loggerName)), (strlen($line) - $pos));

                            $errorLevel = substr($x, 1, ($y = strpos($x, ':') - 1));

                            $message['error_level'] = $errorLevel;

                            $message['message'] = trim(substr($x, ($y + 2)));

                            $trimmed = $message['message'];

                            if (($e = strpos($trimmed, 'EXCEPTION')) !== false) {
                                // 'EXCEPTION: ' stlen = 11
                                $p = 11;
                                $m = substr($trimmed, $p, (strpos($trimmed, ' ', $p) - $p));
                                $message['exception_class'] = $m;

                                $trimmed = substr($trimmed, (strpos($trimmed, $m) + strlen($m) + 1));
                            }

                            if (($e = strpos($trimmed, 'MESSAGE')) !== false) {
                                // 'MESSAGE: ' stlen = 9
                                $p = 9;
                                $m = substr($trimmed, $p, (strpos($trimmed, ' ', $p) - $p));
                                $message['exception_message'] = $m;

                                $trimmed = substr($trimmed, (strpos($trimmed, $m) + strlen($m) + 1));
                            }

                            if (($e = strpos($trimmed, 'FILE')) !== false) {
                                // 'FILE: ' stlen = 6
                                $p = 6;
                                $m = substr($trimmed, $p, (strpos($trimmed, ' ', $p) - $p));
                                $message['exception_file'] = $m;

                                $trimmed = substr($trimmed, (strpos($trimmed, $m) + strlen($m) + 1));
                            }

                            if (($e = strpos($trimmed, 'LINE')) !== false) {
                                // 'LINE: ' stlen = 6
                                $p = 6;
                                $m = substr($trimmed, $p, (strpos($trimmed, ' ', $p) - $p));
                                $message['exception_line'] = $m;

                                $trimmed = substr($trimmed, (strpos($trimmed, $m) + strlen($m) + 1));
                            }

                            $data[$loggerName][] = $message;
                        }
                    }
                }
            } else {
                throw new App\Exception('Could not open file: ' . $path);
            }
        }

        return [
            '$view' => [
                'title' => __('Logger Panel'),
                'name' => 'pagekitlogger:views/index.php'
            ],
            '$data' => [
                'logs' => $data
            ]
        ];
    }
}