<?php

ini_set('display_errors', 1);
error_reporting(-1);

$config = require_once '../config/config.php';
require_once '../core/functions.php';
require_once '../core/Db.php';

$db = Db::getInstance()->getConnection($config['db']);

require_once "../Views/index.tpl.php";

