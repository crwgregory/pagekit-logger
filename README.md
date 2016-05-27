# pagekit-logger
## Allows for easy logging in the Pagekit CMS

#### Install:
```
php pagekit install nativerank/pagekit-logger   // Activate after installing in the System
```

#### Defaults:
```
Name:       PagekitLogger

Log Level: ERROR
```

#### Basic Usage:
```
// Log a simple String
$logger = App::getPagekitLogger();
$logger->log('Hello log!');

// Log an exception
$logger->log($e);
```

#### Options:
```
// Name
$logger = new PagekitLogger(['name'] => 'MyLogger');                // Change Logger name

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
