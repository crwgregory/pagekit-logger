<?php
/**
 * Created by PhpStorm.
 * User: crwgr
 * Date: 4/8/2016
 * Time: 9:46 AM
 */

namespace Nativerank\Utilities;

use MongoDB\Driver\Exception\Exception;
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

  protected $isLogDates;

  protected $isLogMessages;

  protected $module;

  protected $logLevel;

  protected static $instance;

  /**
   * LogHelper constructor.
   * @param array $options
   * @throws \Exception
   */
  public function __construct($options = [])
  {
    $this->module = App::module('pagekit-logger');

    $this->name = array_key_exists('name', $options) ? $options['name'] : 'PagekitLogger';

    if (array_key_exists('logDates', $options)) {

      if (is_bool($options['logDates'])) {

        $this->isLogDates = $options['logDates'];

        $this->module->config('log_dates')->set($options['logDates']);

      } else {

        throw new \Exception('logDates must be a boolean. Got: ' . gettype($options['logDates']));
      }

    } else {

      $this->isLogDates = $this->module->config('log_dates');
    }

    if (array_key_exists('logMessages', $options)) {

      if (is_bool($options['logMessages'])) {

        $this->isLogMessages = $options['logMessages'];

        $this->module->config('log_messages')->set($options['logMessages']);

      } else {

        throw new \Exception('logMessages must be a boolean. Got: ' . gettype($options['logMessages']));
      }

    } else {

      $this->isLogMessages = $this->module->config('log_messages');
    }

    if (array_key_exists('logLevel', $options)) {

      if (is_int($options['logLevel'])) {

        $this->logLevel = $options['logLevel'];

        $this->module->config('log_level')->set($options['logLevel']);

      } else {

        throw new \Exception('logLevel must be a int. Got: ' . gettype($options['logLevel']));
      }

    } else {

      $this->logLevel = $this->module->config('log_level');
    }

    $this->logTruck = new LogTruck();

    self::$instance = $this;
  }

  public static function getInstance($options = [])
  {
    if (self::$instance === null) {

      self::$instance = new self($options);
    }
    return self::$instance;
  }

  /**
   * @param \Exception $e
   * @param int $level
   * @throws App\Exception
   */
  public function logException($e, $level = null)
  {

    $message['exception_class'] = get_class($e);

    $message['message'] = $e->getMessage();

    $message['file'] = $e->getFile();

    $message['line'] = $e->getLine();

    if ($level !== null) {

      if (!array_key_exists($level, $this->levels)) {

        throw new App\Exception('Provided log level did not match any known values: ' . $level);
      }

    } else if (array_key_exists($e->getCode(), $this->levels)) {

      $level = intval($e->getCode());

    } else {

      $level = $this->logLevel;
    }

    $this->log($message, $level);
  }

  /**
   * @param string|\Exception $message What would you like to say?
   * @param integer $level Provided by the constants shamelessly stolen from the Monolog\Logger.php class.
   * Thanks Monolog!
   * @throws App\Exception
   */
  public function log($message, $level = null)
  {
    if (is_a($message, 'Exception')) {

      $this->logException($message, $level);

    } else {

      if ($level === null) {

        $level = $this->logLevel;
      }
      $hash = $this->getHash($message);

      $log = $this->logTruck->getLog($hash);

      $options = $this->logTruck->getOptions($hash);

      if ($options !== null) {

        $options = (array) $options->details;

        if (array_key_exists('keep_dates', $options)) {

          $this->isLogDates = $options['keep_dates'];
        }
        if (array_key_exists('keep_messages', $options)) {

          $this->isLogMessages = $options['keep_messages'];
        }
      }

      $logMessage = null;

      if (is_array($message)) {

        if ($this->isLogMessages) {

          $logMessage = $message['message'];
        }
        unset($message['message']);

        $exception = $message;

      } else {

        $logMessage = $message;

        $exception = null;
      }


      if ($log === null) {

        $date = null;

        if ($this->isLogDates === true) {

          $date = gmdate(DATE_ATOM);
        }

        $log = LoggerORM::create(
            [
                'log_hash' => $hash,
                'count' => 1,
                'error_level' => $level,
                'logger_name' => $this->name,
                'messages' => [$logMessage],
                'exception' => $exception,
                'dates' => [$date]
            ]
        );

      } else {

        $log->count = intval($log->count) + 1;

        if ($this->isLogMessages) {

          if (array_search($logMessage, $log->messages) === false) {

            array_push($log->messages, $logMessage);
          }
        }
        if ($this->isLogDates) {

          array_push($log->dates, gmdate(DATE_ATOM));
        }
      }
      $log->save();
    }
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

        if ($key !== 'message') {

          for ($i = 0; $i < strlen($value); $i += 3) {

            $toHash .= substr($value, $i, 1);
          }
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