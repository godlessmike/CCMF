<?php

session_start();
define('ROOTPATH', __DIR__ . DIRECTORY_SEPARATOR);

/**
 * Main App File
 * 
 * @author Michał Borowiec <michal@cursed.pl>
 * @version 1.0 
 * @package app/controller
 * 
 */

require '../app/core/autoload.php';

$app = new \App\App;
$app->run();
