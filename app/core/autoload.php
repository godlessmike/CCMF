<?php

/**
 * Autoload File
 * 
 * @author Michał Borowiec <michal@cursed.pl>
 * @version 1.0 
 * @package app
 * 
 */

spl_autoload_register(function($className){
   require "../app/models/" . ucfirst($className) . "Model.php";
});

require "config.php";
require "functions.php";
require "Database.php";
require "Model.php";
require "Controller.php";
require "App.php";