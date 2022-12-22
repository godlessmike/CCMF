<?php

/**
 * Home Controller
 * 
 * @author Michał Borowiec <michal@cursed.pl>
 * @version 1.0 
 * @package app/controller
 * 
 */

class Home extends Controller {
    public function index() {
        echo "Home Controller -> index Method";
        $this->view('home');
    }
}