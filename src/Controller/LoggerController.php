<?php
/**
 * Created by PhpStorm.
 * User: crwgr
 * Date: 5/12/2016
 * Time: 1:17 PM
 */

namespace Nativerank\Logger\Controller;

use Nativerank\Logger\Utilities\LogTrimmer;
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
     * @var LogTrimmer
     */
    protected $logTrimmer;

    /**
     * LoggerController constructor.
     */
    public function __construct()
    {
        $this->logTrimmer = new LogTrimmer();
    }

    /**
     * @Route("/")
     * @Method("GET")
     */
    function indexAction()
    {
//        $e = new App\Exception('hello');
//        $logger = new PagekitLogger();
//        $logger->logException($e);

        $logs = $this->logTrimmer->cutLogs();

        return [
            '$view' => [
                'title' => __('Logger Panel'),
                'name' => 'pagekitlogger:views/index.php'
            ],
            '$data' => [
                'logs' => $logs
            ]
        ];
    }

    /**
     * @Route("/settings")
     * @Method("GET")
     */
    function settingsAction()
    {
//        $e = new App\Exception('hello');
//        $logger = new PagekitLogger();
//        $logger->logException($e);

        return [
            '$view' => [
                'title' => __('Logger Settings'),
                'name' => 'pagekitlogger:views/settings.php'
            ],
            '$data' => [

            ]
        ];
    }

}