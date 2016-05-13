<?php
/**
 * Created by PhpStorm.
 * User: crwgr
 * Date: 4/8/2016
 * Time: 9:46 AM
 */

namespace Nativerank\Utilities;

use Monolog\Handler\StreamHandler;
use Pagekit\Log\Logger;
use Pagekit\Application as App;
use Nativerank\Logger\Model\LoggerORM;
use Nativerank\Logger\Utilities\LogTruck;

class PagekitLogger
{
  /**
   * Detailed debug information
   */
  const DEBUG = 100;

  /**
   * Interesting events
   *
   * Examples: User logs in, SQL logs.
   */
  const INFO = 200;

  /**
   * Uncommon events
   */
  const NOTICE = 250;

  /**
   * Exceptional occurrences that are not errors
   *
   * Examples: Use of deprecated APIs, poor use of an API,
   * undesirable things that are not necessarily wrong.
   */
  const WARNING = 300;

  /**
   * Runtime errors
   */
  const ERROR = 400;

  /**
   * Critical conditions
   *
   * Example: Application component unavailable, unexpected exception.
   */
  const CRITICAL = 500;

  /**
   * Action must be taken immediately
   *
   * Example: Entire website down, database unavailable, etc.
   * This should trigger the SMS alerts and wake you up.
   */
  const ALERT = 550;

  /**
   * Urgent alert.
   */
  const EMERGENCY = 600;

  /**
   * Logging levels from syslog protocol defined in RFC 5424
   *
   * @var array $levels Logging levels
   */
  protected $levels = array(
     100 => 'DEBUG',
     200 => 'INFO',
     250 => 'NOTICE',
     300 => 'WARNING',
     400 => 'ERROR',
     500 => 'CRITICAL',
     550 => 'ALERT',
     600 => 'EMERGENCY',
  );

  /**
   * @var string
   */
  protected $logPath;


  /**
   * @var Logger
   */
  protected $logger;

  /**
   * @var string
   */
  protected $name;

  /**
   * @var LogTruck
   */
  protected $logTruck;

  /**
   * LogHelper constructor.
   * @param string $name Name for the Logger ie: Nativerank, Pagekit, MyExtension
   * @param string $filePath Allows for multiple log files default = errors.log ie: MyExtension/MyClass.log,
   *  MyCompany/MyException.log
   */
  public function __construct($name = 'PagekitLogger', $filePath = 'errors.log')
  {
    $this->logPath = App::module('pagekit-logger')->config('log_path') . '/' . $filePath;

    $currentPaths = App::module('pagekit-logger')->config('current_paths');

    $currentNames = App::module('pagekit-logger')->config('logger_names');

    if (array_search($this->logPath, $currentPaths) === false) {

      $currentPaths[] = $this->logPath;

      App::config('pagekit-logger')->set('current_paths', $currentPaths);
    }

    if (array_search($name, $currentNames) === false) {

      $currentNames[] = $name;

      App::config('pagekit-logger')->set('logger_names', $currentNames);
    }

    $this->logger = new Logger($name);

    $this->name = $name;

    $this->logTruck = new LogTruck();
  }

  /**
   * @param \Exception $e
   * @param boolean $trace
   * @param int $level
   * @throws App\Exception
   */
  public function logException($e, $trace = false, $level = null) {

    $message['exception_class'] = get_class($e);

    $message['message'] = $e->getMessage();

    $message['file'] = $e->getFile();

    $message['line'] = $e->getLine();

    if ($trace === true) {

      $message['trace'] = $e->getTraceAsString();

    }

    if ($level !== null) {

      if (!array_key_exists($level, $this->levels)) {

        throw new App\Exception('Provided log level did not match any known values: ' . $level);
      }

    } else if (array_key_exists($e->getCode(), $this->levels)) {

      $level = intval($e->getCode());

    } else {

      $level = Logger::ERROR;
    }

    $this->log($message, $level);
  }

  /**
   * @param string $message What would you like to say?
   * @param integer $level Provided by the constants shamelessly stolen from the Monolog\Logger.php class.
   * Thanks Monolog!
   * @throws App\Exception
   */
  public function log($message, $level  = Logger::ERROR)
  {
    // TODO: Add mailing for certain logs.

    $hash = $this->getHash($message);

    $log = $this->logTruck->getLog($hash);

    if ($log === null) {

      $log = LoggerORM::create(
          [
            'log_hash' => $hash,
            'count' => 1,
            'error_level' => $level,
            'logger_name' => $this->name,
            'log' => $message,
            'dates' => [gmdate(DATE_ATOM)]
          ]
      );

    } else {

      $log->count = intval($log->count) + 1;

      array_push($log->dates, gmdate(DATE_ATOM));

    }

    $log->save();
  }

  /**
   * @param $message
   * @return string
   */
  private function getHash($message)
  {
    $toHash = '';

    if (is_array($message)) {

      foreach ($message as $key => $value) {

        for ($i = 0; $i < strlen($value); $i += 3) {

          $toHash .= substr($value, $i, 1);
        }
      }
    } else {

      $messageLngth = strlen($message);

      for ($i = 0; $i < $messageLngth; $i++) {

        $toHash .= substr($message, $i, 1);
      }
    }
    return hash('md5', $toHash);
  }
}