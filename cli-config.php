<?php

use Doctrine\DBAL\DriverManager;

require_once "vendor/autoload.php";

// Load user config file (config.ini) to get access to DB credentisla
$f3 = Base::instance();
$f3->config("config.ini");

$connection = DriverManager::getConnection([
    "host" => $f3->get("DB.HOSTNAME"),
    "user" => $f3->get("DB.USERNAME"),
    "password" => $f3->get("DB.PASSWORD"),
    "dbname" => $f3->get("DB.NAME"),
    "driver" => $f3->get("DB.DRIVER"),
]);