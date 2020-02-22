<?php

require_once "vendor/autoload.php";

$f3 = Base::instance();

$f3->config("config.ini");

$f3->config("App/config/config.cfg");

// load the english translation as fallback
// we load the config file of the user "over" the english one
$f3->config("App/config/languages/en_us.cfg");

$f3->run();