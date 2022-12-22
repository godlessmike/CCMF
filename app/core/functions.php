<?php

defined('ROOTPATH') OR die('ACCES DENIED');

/**
 * Misc Functions File
 * 
 * @author Michał Borowiec <michal@cursed.pl>
 * @version 1.0 
 * @package app
 * 
 */

function show(mixed $content) {
   echo "<pre>";
   var_dump($content);
   echo "</pre>";
}

function esc(string $string) {
   return htmlspecialchars($string);
}

