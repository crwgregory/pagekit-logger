<?php
/**
 * Created by PhpStorm.
 * User: crwgr
 * Date: 5/12/2016
 * Time: 1:17 PM
 */

namespace Nativerank\Logger\Controller;

use Nativerank\Logger\Utilities\LogTruck;
use Nativerank\Logger\Model\LoggerOptionsORM;

use Pagekit\Application as App;

/**
 * Class LoggerController
 * @package Nativerank\Logger\Controller
 * @access(admin=true)
 */
class LoggerController
{

    protected $logTruck;

    protected $module;

    /**
     * LoggerController constructor.
     */
    public function __construct()
    {
        $this->logTruck = new LogTruck();

        $this->module = App::module('pagekit-logger');
    }

    /**
     * @Route("/")
     * @Method("GET")
     */
    function indexAction()
    {
        $logs = $this->logTruck->getLogs();

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
        return [
            '$view' => [
                'title' => __('Logger Settings'),
                'name' => 'pagekitlogger:views/settings.php'
            ],
            '$data' => [
                'settings' => $this->module->config
            ]
        ];
    }

    /**
     * @Route("/save-settings", defaults={"settings" = null}, csrf=true)
     * @Method("POST")
     * @Request({"settings" = "array"})
     */
    function saveSettingsAction($settings)
    {
        try {

            $options = $this->logTruck->getOptions($settings['hash']);

            if ($options !== null) {

                $details = $options->details;

                $details['keep_dates'] = $settings['keepDates'];

                $details['keep_messages'] = $settings['keepMessages'];

                $options->details = $details;

            } else {

                $options = LoggerOptionsORM::create([
                    'log_hash' => $settings['hash'],
                    'details' => [
                        'keep_dates' => $settings['keepDates'],
                        'keep_messages' => $settings['keepMessages'],
                    ]
                ]);
            }

            $options->save();

            return ['success' => true, 'settings' => $settings];

        } catch (\Exception $e) {

            return ['success' => false, 'exception_message' => $e->getMessage()];
        }
    }

    /**
     * @Route("/save-default-settings", defaults={"settings" = null}, csrf=true)
     * @Method("POST")
     * @Request({"settings" = "array"})
     */
    function saveDefaultSettingsAction($settings)
    {
        try {

            App::config('pagekit-logger')->set('log_dates', $settings['keepDates']);

            App::config('pagekit-logger')->set('log_messages', $settings['keepMessages']);

            App::config('pagekit-logger')->set('log_level', $settings['logLevel']);

            return ['success' => true, 'settings' => $settings];

        } catch (\Exception $e) {

            return ['success' => false, 'exception_message' => $e->getMessage()];
        }
    }

    /**
     * @Route("/delete", defaults={"log_hash" = null}, csrf=true)
     * @Method("DELETE")
     * @Request({"log_hash" = "string"})
     */
    function deleteAction($log_hash)
    {
        $log = $this->logTruck->getLog($log_hash);

        $options = $this->logTruck->getOptions($log_hash);

        try {

            $log->delete();

            if ($options !== null) {

                $options->delete();
            }

            return ['success' => true];

        } catch (\Exception $e) {

            return ['success' => false, 'exception_message' => $e->getMessage()];
        }
    }
}