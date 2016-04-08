# pagekitlogger
Allows for easy logging in the Pagekit CMS

The default path for logs is at Pagekits root ./tmp/logs/
This service will make a file called errors.log by default at that path, but you can call the file whatever you like, and organize your logs however you like.

Usage:
```
$logger = new PagekitLogger('MyLogger');
$logger->log('Hello log!', PagekitLogger::INFO);
```

Options:
```
$logger = new PagekitLogger('MyLogger', 'MyExtension/MyLog.log');
```
This will create a logger that will log into Pagekits tmp/logs/MyExtension/MyLog.log

```
$logger = new PagekitLogger('MyLogger', 'MyLog.log');
```
This will create a logger that will log into Pagekits tmp/logs/MyLog.log
