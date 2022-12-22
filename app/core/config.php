<?php

defined('ROOTPATH') OR die('ACCES DENIED');

/**
 * Main Configuration file
 * 
 * @author Michał Borowiec <michal@cursed.pl>
 * @version 1.0 
 * @package app
 * 
 */
$theme = 'simple';
$pass_length  = 6; /* min value: 6 */
$app_name = 'CMF'; 
$app_color = 'rgba(00, 66, 33, 0)'; /* rgba */
$debug = true;
$minPHPVersion = 8.0;

if($_SERVER['SERVER_NAME'] === "localhost") {
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'cmf';
    $dbdrvr = 'mysql';
} else {
    $dbhost = '';
    $dbuser = '';
    $dbpass = '';
    $dbname = '';
    $dbdrvr = '';
}

define('DBHOST', $dbhost);
define('DBUSER', $dbuser);
define('DBPASS', $dbpass);
define('DBNAME', $dbname);
define('DBDRVR', $dbdrvr);
define('PASS_LENGTH', $pass_length);
define('APP_NAME', $app_name);
define('APP_COLOR', $app_color);
define('DEBUG', $debug);
define('ROOT', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/' . trim($_SERVER['SCRIPT_NAME'], '/index.php'));
define('THEME', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/' . trim($_SERVER['SCRIPT_NAME'], '/index.php') . '/themes/' . $theme);
define('ATHEME', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/' . trim($_SERVER['SCRIPT_NAME'], '/index.php') . '/themes/admin');

if(phpversion() < $minPHPVersion) {
    die ("Invalid PHP version (" . phpversion() . " instead $minPHPVersion)");
}

ini_set('display_errors', $debug);