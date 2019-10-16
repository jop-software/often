<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Symfony\Component\Console\Helper\HelperSet;

require_once "vendor/autoload.php";

// Load user config file (config.ini) to get access to DB credentisla
$f3 = Base::instance();
$f3->config("config.ini");

// Initiate connection
$connection = DriverManager::getConnection([
    "host" => $f3->get("DB.HOSTNAME"),
    "user" => $f3->get("DB.USERNAME"),
    "password" => $f3->get("DB.PASSWORD"),
    "dbname" => $f3->get("DB.NAME"),
    "driver" => $f3->get("DB.DRIVER"),
]);

// return HelperSet with Connection
return new HelperSet([
    "db" => new ConnectionHelper($connection)
]);