<?php
ini_set('display_errors', 1);
error_reporting(-1);

define("ROOT", dirname(__DIR__));
define("HOST", $_SERVER['HTTP_HOST']);

const WWW = ROOT."/public";

return [
    'db' => [
        'host' => 'localhost',
        'port' => '3306',
        'username' => 'admin',
        'password' => 'admin',
        'dbname' => 'iocode',
        'charset' => 'utf8',
        'options' => [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]
    ]
];
