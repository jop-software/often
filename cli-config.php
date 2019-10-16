<?php

require_once "vendor/autoload.php";

// Load user config file (config.ini) to get access to DB credentisla
$f3 = Base::instance();
$f3->config("config.ini");