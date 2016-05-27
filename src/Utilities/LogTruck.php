<?php
/**
 * Created by PhpStorm.
 * User: crwgr
 * Date: 5/13/2016
 * Time: 3:29 PM
 */

namespace Nativerank\Logger\Utilities;

use Nativerank\Logger\Model\LoggerORM;
use Nativerank\Logger\Model\LoggerOptionsORM;

use Pagekit\Application as App;

class LogTruck
{

    protected $index;

    protected $module;

    /**
     * LogTruck constructor.
     */
    public function __construct()
    {
        $this->module = App::module('pagekit-logger');
    }

    /**
     * Abraham Lincoln lived in a log cabin
     * @return array
     */
    public function getLogs()
    {
        $logsArray = [];

        $logs = LoggerORM::findAll();

        foreach ($logs as $log) {

            $isException = false;

            $log = (array) $log;

            $logCabin = [];

            if ($log['exception'] !== null && is_array($log['exception']) && count($log['exception']) > 0) {

                $isException = true;

                foreach ($log['exception'] as $key => $value) {

                    $key = $this->deathByCamels($key);

                    $logCabin[$key] = $value;
                }

                if (($options = $this->getOptions($log['log_hash'])) !== null) {

                    $logCabin['options'] = $options->details;

                } else {

                    $logCabin['options'] = [
                        'keep_dates' => $this->module->config('log_dates'),
                        'keep_messages' => $this->module->config('log_messages')
                    ];
                }
            }

            $logCabin['message'] = $log['messages'];

            $logCabin['dates'] = array_map(function($date) {

                if ($date === null) {

                    return null;
                }
                $date = new \DateTime($date);

                return date_format($date, 'Y/m/d H:i:s');

            }, $log['dates']);

            $logCabin['count'] = $log['count'];

            $logCabin['errorLevel'] = $log['error_level'];

            $logCabin['loggerName'] = $log['logger_name'];

            $logCabin['id'] = $log['id'];

            $logCabin['logHash'] = $log['log_hash'];

            $logsArray[] = $isException ? ['exception' => $logCabin] : ['message' => $logCabin];
        }

        return $logsArray;
    }

    /**
     * @param $hash
     * @return mixed
     */
    public function getOptions($hash)
    {
        return LoggerOptionsORM::where(['log_hash = :hash'], ['hash' => $hash])->first();
    }

    /**
     * @param $hash
     * @return mixed
     */
    public function getLog($hash)
    {
        return LoggerORM::where(['log_hash = :hash'], ['hash' => $hash])->first();
    }

    /**
     * Returns a Javascript formatted name from a database formatted one
     * hello_world => helloWorld
     * @param $string
     * @return string
     */
    private function deathByCamels($string)
    {
        $this->index = 0;
        return implode('', array_map(function($el) {
            $this->index++;
            return $this->index === 1 ? $el : ucfirst($el);
        }, explode(' ', str_replace('_', ' ', $string))));
    }
}
