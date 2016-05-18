<?php
/**
 * Created by PhpStorm.
 * User: crwgr
 * Date: 5/12/2016
 * Time: 1:17 PM
 */

namespace Nativerank\Logger\Controller;

use Nativerank\Logger\Utilities\LogTrimmer;
use Nativerank\Logger\Utilities\LogTruck;
use Pagekit\Application as App;

use Nativerank\Utilities\PagekitLogger;
use Pagekit\Mail\Mailer;

/**
 * Class LoggerController
 * @package Nativerank\Logger\Controller
 * @access(admin=true)
 */
class LoggerController
{

    protected $logTruck;

    /**
     * LoggerController constructor.
     */
    public function __construct()
    {

        $this->logTruck = new LogTruck();
    }

    /**
     * @Route("/")
     * @Method("GET")
     */
    function indexAction()
    {

//
//        $logger->log('hello world1');

//        $mailer = App::mailer()->create();
//
//        $mailer->setTo('crwgregory@gmail.com')
//            ->setSubject('from pagekit')
//            ->setBody('yolo')
//            ->send();

        $logs = $this->logTruck->getLogs();

//        $e = new App\Exception('hello wor2341');
//        $logger = new PagekitLogger();
//        $logger->logException($e);

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