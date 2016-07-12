# pagekit-logger
## Allows for easy logging in the Pagekit CMS

![pagekit-logger-preview](https://cloud.githubusercontent.com/assets/9405969/16782635/b00867e0-483d-11e6-9ab5-5dbac842bd21.gif)

#### Install:
```
php pagekit install nativerank/pagekit-logger   // Activate after installing in the System
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
$logger->log($e, PagekitLogger::CRITICAL);                          // Custom Error Level
```

#### Defaults:
```
Name:       PagekitLogger

Log Level:  ERROR
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
