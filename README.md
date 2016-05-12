# pagekit-logger
## Allows for easy logging in the Pagekit CMS

#### Install:
```
php pagekit install nativerank/pagekit-logger   // Activate after installing in the System
```

#### Defaults:
```
Name:       PagekitLogger
Path:       pagekit/tmp/logs/errors.log

Message Logging:
Log Level:  ERROR

Exception Logging:
Print Trace: false
Log Level: ERROR

// Message Logging looks like:
[2016-04-08 16:24:24] PagekitLogger.WARNING: Hello Log! [] []

// Exception Logging looks like:
[2016-04-08 16:24:24] PagekitLogger.ERROR: MESSAGE: (exception message) FILE: (path to file) LINE: (line of error) TRACE: (if the trace flag is set to true)[] []
```

#### Usage:
```
// Log a simple String
$logger = new PagekitLogger();
$logger->log('Hello log!');

// Register the logger in the index.php file (recommended)
$logger = App::getLogger();
$logger->log('Hello log!');

// Log an exception
$logger->logException($e);
```

#### Options:
```
// Name & Location
$logger = new PagekitLogger('MyLogger');                            // Change Logger name
$logger = new PagekitLogger('MyLogger', 'MyLog.log');               // Change file name (./tmp/logs/MyLog.log)
$logger = new PagekitLogger('MyLogger', 'MyExtension/MyLog.log');   // Change path and file name (./tmp/logs/MyExtension/MyLog.log)

// Log Level
$logger->log('Hello log!', PagekitLogger::INFO);                    // Log level INFO

// Exceptions:
$logger->logException($e, true);                                    // Log the exception trace
$logger->logException($e, {true|false}, PagekitLogger::CRITICAL);   // Custom Error Level
```

#### Log Levels:
<ul>
    <li>DEBUG</li>
    <li>INFO</li>
    <li>NOTICE</li>
    <li>WARNING</li>
    <li>ERROR</li>
    <li>CRITICAL</li>
    <li>ALERT</li>
    <li>EMERGENCY</li>
</ul>

#### License:
MIT
