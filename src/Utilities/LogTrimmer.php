<?php
/**
 * Created by PhpStorm.
 * User: crwgr
 * Date: 5/13/2016
 * Time: 9:10 AM
 */

namespace Nativerank\Logger\Utilities;

use Pagekit\Application as App;


class LogTrimmer
{

    protected $branches = [
        'EXCEPTION',
        'MESSAGE',
        'FILE',
        'LINE'
    ];

    public function cutLogs()
    {
        $cutLogs = [];

        $logs = $this->getLogs();

        foreach ($logs as $log) {

            $cutLogs[] = $this->parseLog($log);
        }

        return $cutLogs;
    }

    private function getLogs()
    {
        $currentPaths = App::module('pagekit-logger')->config('current_paths');

        $logs = [];

        foreach ($currentPaths as $path) {

            $handle = fopen($path, 'r');

            if ($handle) {

                while (($line = fgets($handle)) !== false) {

                    $logs[] = $line;
                }
            } else {

                throw new App\Exception('Could not open file: ' . $path);
            }
        }
        return $logs;
    }

    private function parseLog($log)
    {
        $cutLog = [];

        $cutLog['loggerName'] = $this->cutBy($log);

        $trimmed = substr($log, (strpos($log, $cutLog['loggerName'])) + strlen($cutLog['loggerName']));

        $x = strpos($trimmed, ':') - 1;

        $cutLog['errorLevel'] = $this->getErrorLevel($trimmed, $x);

        $trimmed = trim(substr($trimmed, ($x + 2)));

        $branches = $this->getBranches($trimmed);

        foreach ($branches as $key => $branch) {

            $cutLog[$key] = $branch;
        }

        $cutLog['date'] = $this->cutOn($log);

        if (array_key_exists('exception', $cutLog)) {

            return ['exception' => $cutLog];

        } else {

            return ['message' => $cutLog];
        }
    }

    private function getErrorLevel($log, $x)
    {
        return substr($log, 1, $x);
    }

    private function cutBy($log)
    {
        $currentNames = App::module('pagekit-logger')->config('logger_names');

        foreach ($currentNames as $loggerName) {

            if (($pos = strpos($log, $loggerName)) !== false) {

                return $loggerName;

            }
        }
    }

    private function cutOn($log)
    {
        $date = substr($log, 1, 19);
        return $date;
    }

    private function getBranches($log)
    {
        $trimmed = $log;

        $logToReturn = [];

        foreach ($this->branches as $branch) {

            if (($e = strpos($trimmed, $branch)) !== false) {

                // Adding two to make up for the colon and space in the string
                // ex: 'MESSAGE: '
                $p = strlen($branch) + 2;

                $m = substr($trimmed, $p, (strpos($trimmed, ' ', $p) - $p));

                $logToReturn[strtolower($branch)] = $m;

                $trimmed = substr($trimmed, (strpos($trimmed, $m) + strlen($m) + 1));
            }
        }

        return $logToReturn;
    }
}