<?php
/**
 * Created by PhpStorm.
 * User: crwgr
 * Date: 5/13/2016
 * Time: 3:29 PM
 */

namespace Nativerank\Logger\Utilities;

use Nativerank\Logger\Model\LoggerORM;

class LogTruck
{

    protected $index;

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

            if (is_array($log['log'])) {

                $isException = true;

                foreach ($log['log'] as $key => $value) {

                    $key = $this->deathByCamels($key);

                    $logCabin[$key] = $value;

                }

            } else {

                $logCabin['message'] = $log['log'];

            }

            $logCabin['dates'] = $log['dates'];

            $logCabin['count'] = $log['count'];

            $logCabin['errorLevel'] = $log['error_level'];

            $logCabin['loggerName'] = $log['logger_name'];

            $logCabin['id'] = $log['id'];

            $logsArray[] = $isException ? ['exception' => $logCabin] : ['message' => $logCabin];

        }
//        var_dump($logsArray);
        return $logsArray;
    }

    /**
     * @param $hash
     * @return mixed
     */
    public function getLog($hash)
    {
        return LoggerORM::where(['log_hash = :hash'], ['hash' => $hash])->first();
    }

    private function deathByCamels($string)
    {
        $this->index = 0;
        return implode('', array_map(function($el) {
            $this->index++;
            return $this->index === 1 ? $el : ucfirst($el);
        }, explode(' ', str_replace('_', ' ', $string))));
    }
}
