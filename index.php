<?php
declare(strict_types = 1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require 'vendor/autoload.php';
//require_once(__DIR__.'/vendor/autoload.php');
use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$logger = new Logger('channel-name');
$logger->pushHandler(new StreamHandler(__DIR__.'/info.log', Logger::INFO));
$logDEBUG = new Logger('DEBUG');
$logINFO = new Logger('INFO');
$logWARNING = new Logger('WARNING');
$logNOTICE = new Logger('NOTICE');
$logEMERGENCY = new Logger('EMERGENCY');
$logDANGER = new Logger('DANGER');

$logDANGER->pushHandler(new StreamHandler(__DIR__.'danger.log', Logger::ERROR));

$logDEBUG->pushHandler(new StreamHandler(__DIR__ . '/debug.log', Logger::DEBUG));

$logINFO->pushHandler(new StreamHandler(__DIR__ . '/info.log'));
$logINFO->pushHandler(new BrowserConsoleHandler());

$logWARNING->pushHandler(new StreamHandler(__DIR__ . '/warning.log', Logger::WARNING));

$logNOTICE->pushHandler(new StreamHandler(__DIR__ . '/notice.log', Logger::NOTICE));

if(isset($_GET['DEBUG'])){
    $x = $_GET['message'];
    $logDEBUG->debug('DEBUG (100): Detailed debug information' . $x);
}
if(isset($_GET['EMERGENCY'])){
    $x = $_GET['message'];
    $logEMERGENCY->debug('EMERGENCY (100): Detailed debug information' . $x);
}
if(isset($_GET['DANGER'])){
    $x = $_GET['message'];
    $logDANGER->debug('DANGER (100): Detailed debug information' . $x);
}



if(isset($_GET['INFO'])){
    $x = $_GET['message'];
    $logINFO->info('INFO (200): Interesting events. Examples: User logs in, SQL logs. ' . $x);
}

if(isset($_GET['WARNING'])){
    $x = $_GET['message'];
    $logWARNING->warning('WARNING (300): Exceptional occurrences that are not errors. Examples: Use of deprecated APIs, poor use of an API, undesirable things that are not necessarily wrong ' . $x);
}

if(isset($_GET['NOTICE'])){
    $x = $_GET['message'];
    $logINFO->info('NOTICE (250): Normal but significant events.' . $x);
}

?>

<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Logger</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
</head>
<body>
<form method="get">
    <h1>Using Monolog with Composer</h1>

    <input type="text" name="message" placeholder="My log message" class="form-control" required />

    <button type="submit" name="DEBUG" value="DEBUG" class="btn btn-info">DEBUG (100): Detailed debug information.</button>
    <button type="submit" name="INFO" value="INFO" class="btn btn-info">INFO (200): Interesting events. Examples: User logs in, SQL logs.
    </button>
    <button type="submit" name="NOTICE" value="NOTICE" class="btn btn-info">NOTICE (250): Normal but significant events.
    </button>
    <button type="submit" name="WARNING" value="WARNING" class="btn btn-warning">WARNING (300): Exceptional occurrences that are not errors. Examples: Use of deprecated APIs, poor use of an API, undesirable things that are not necessarily wrong.
    </button>
    <button type="submit" name="ERROR" value="ERROR" class="btn btn-danger">ERROR (400): Runtime errors that do not require immediate action but should typically be logged and monitored.
    </button>
    <button type="submit" name="CRITICAL" value="CRITICAL" class="btn btn-danger">CRITICAL (500): Critical conditions. Example: Application component unavailable, unexpected exception.
    </button>
    <button type="submit" name="ALERT" value="ALERT" class="btn btn-danger">ALERT (550): Action must be taken immediately. Example: Entire website down, database unavailable, etc. This should trigger the SMS alerts and wake you up.
    </button>
    <button type="submit" name="EMERGENCY" value="EMERGENCY" class="btn btn-dark">EMERGENCY (600): Emergency: system is unusable.
    </button>
</form>



</body>
</html>