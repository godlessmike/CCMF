<?php

/**
 * Main App File
 * 
 * @author Michał Borowiec <michal@cursed.pl>
 * @version 1.0 
 * @package app/controller
 * 
 */

session_start();
require '../app/core/autoload.php';

$app = new App;
$app->run();
