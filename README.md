# pagekitlogger
## Allows for easy logging in the Pagekit CMS

#### Install:
```
//You have to activate the extension after installing
php pagekit install nativerank/pagekit-logging 
```

#### Defaults:
```
Path: pagekit/tmp/logs/errors.log
Log Level: ERROR

// Looks like
[2016-04-08 16:24:24] MyLogger.WARNING: Hello Log! [] []
```

#### Usage:
```
$logger = new PagekitLogger('MyLogger');
$logger->log('Hello log!');
```
##### Or
```
$logger = App::logger();
$logger->log('Hello log!');
```

#### Options:
```
$logger = new PagekitLogger('MyLogger', 'MyLog.log');               // Change file name
$logger = new PagekitLogger('MyLogger', 'MyExtension/MyLog.log');   // Change path and file name

$logger->log('Hello log!', PagekitLogger::INFO);                    // Log level INFO
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