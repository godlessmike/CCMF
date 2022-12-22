<?php

namespace App;

defined('ROOTPATH') OR die('ACCES DENIED');

/**
 * App Class
 * 
 * @author Michał Borowiec <michal@cursed.pl>
 * @version 1.0 
 * @package app
 * 
 */

class App {
    private string $controller = 'Home';
    private string $method = 'index';

    private function splitURL() {
        $URL = $_GET['url'] ?? 'home';
        return $URL = explode("/", trim($URL, "/"));
    }

    public function run(){
        $URL = $this->splitURL();
        $file = "../app/controllers/" . ucfirst($URL[0]) . "Controller.php";
        if(file_exists($file)) {
            require $file;
            $this->controller = ucfirst($URL[0]);
            unset($URL[0]);
        } elseif (file_exists("../app/controllers/" . $URL[0] . "/" . ucfirst($URL[0]) . "Controller.php")) {
            require "../app/controllers/" . $URL[0] . "/" . ucfirst($URL[0]) . "Controller.php";
        } else {
            require "../app/controllers/_404Controller.php";
            $this->controller = "_404";
        }

        $callback = new $this->controller;

        if(!empty($URL[1])) {
            if(method_exists($callback, $URL[1])) {
                $this->method = $URL[1];
                unset($URL[1]);
            }
        }
        
        call_user_func_array([$callback, $this->method], $URL);
    }
}