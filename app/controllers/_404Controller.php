<?php

defined('ROOTPATH') OR die('ACCES DENIED');

/**
 * _404 Controller
 * 
 * @author Michał Borowiec <michal@cursed.pl>
 * @version 1.0 
 * @package app/controller
 * 
 */

class _404 {
     use Core\Controller;
    public function index() {

        $this->view('404');

    }

}