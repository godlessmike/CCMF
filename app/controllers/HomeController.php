<?php

namespace Controllers;

defined('ROOTPATH') OR die('ACCES DENIED');

/**
 * Home Controller
 * 
 * @author Michał Borowiec <michal@cursed.pl>
 * @version 1.0 
 * @package app/controller
 * 
 */

class Home {
    use Controller;
    public function index() {
        $this->view('home');

    }

}