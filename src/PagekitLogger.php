<?php
/**
 * Created by PhpStorm.
 * User: crwgr
 * Date: 4/8/2016
 * Time: 9:46 AM
 */

namespace Nativerank\Utilities;

use Monolog\Handler\StreamHandler;
use Pagekit\Application\Traits\Container;
use Pagekit\Log\Logger;
use Pagekit\Application as App;

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
   * @var Container
   */
  protected $appInstance;

  /**
   * @var string
   */
  protected $logPath;


  /**
   * @var Logger
   */
  protected $logger;

  /**
   * LogHelper constructor.
   * @param string $name Name for the Logger ie: Nativerank, Pagekit, MyExtension
   * @param string $filePath Allows for multiple log files default = errors.log ie: MyExtension/MyClass.log,
   *  MyCompany/MyException.log
   */
  public function __construct($name = 'PagekitLogger', $filePath = 'errors.log')
  {
    $this->appInstance = App::getInstance();
    $this->logPath = $this->appInstance->offsetGet('path.logs') . '/' . $filePath;
    $this->logger = new Logger($name);
  }

  /**
   * @param \Exception $e
   * @param boolean $trace
   * @param int $level
   * @throws App\Exception
   */
  public function logException($e, $trace = false, $level = null) {
    $message =  'MESSAGE: ' . $e->getMessage() .
                ' FILE: ' . $e->getFile() .
                ' LINE: ' . $e->getLine();

    if ($trace == true) {
      $message .= ' TRACE: ' . $e->getTraceAsString();
    }

    if ($level != null) {
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
  public function log($message, $level  = Logger::ERROR) {

    // TODO: Add mailing for certain logs.
    switch($level) {
      case $this->levels[$level] == 'DEBUG':
        $this->logger->pushHandler(new StreamHandler($this->logPath, Logger::DEBUG));
        $this->logger->addDebug($message);
        break;
      case $this->levels[$level] == 'INFO':
        $this->logger->pushHandler(new StreamHandler($this->logPath, Logger::INFO));
        $this->logger->addInfo($message);
        break;
      case $this->levels[$level] == 'NOTICE':
        $this->logger->pushHandler(new StreamHandler($this->logPath, Logger::NOTICE));
        $this->logger->addNotice($message);
        break;
      case $this->levels[$level] == 'WARNING':
        $this->logger->pushHandler(new StreamHandler($this->logPath, Logger::WARNING));
        $this->logger->addWarning($message);
        break;
      case $this->levels[$level] == 'ERROR':
        $this->logger->pushHandler(new StreamHandler($this->logPath, Logger::ERROR));
        $this->logger->addError($message);
        break;
      case $this->levels[$level] == 'CRITICAL':
        $this->logger->pushHandler(new StreamHandler($this->logPath, Logger::CRITICAL));
        $this->logger->addCritical($message);
        break;
      case $this->levels[$level] == 'ALERT':
        $this->logger->pushHandler(new StreamHandler($this->logPath, Logger::ALERT));
        $this->logger->addAlert($message);
        break;
      case $this->levels[$level] == 'EMERGENCY':
        $this->logger->pushHandler(new StreamHandler($this->logPath, Logger::EMERGENCY));
        $this->logger->addEmergency($message);
        break;
      default:
        throw new App\Exception('Provided log level did not match any known values: ' . $level);
    }
  }
}