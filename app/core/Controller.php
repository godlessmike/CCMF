<?php

namespace Core;

defined('ROOTPATH') OR die('ACCES DENIED');

/**
 * Controller Class
 * 
 * @author Michał Borowiec <michal@cursed.pl>
 * @version 1.0 
 * @package Core\Controller
 * 
 */

trait Controller {
    public function view($view) {
        $file = "../app/views/" . $view . "View.php";
        if(file_exists($file)) {
            require $file;
        } else {
            require "../app/views/404View.php";
        }
    }
}