<?php

/**
 * Products Controller
 * 
 * @author Michał Borowiec <michal@cursed.pl>
 * @version 1.0 
 * @package app/controller
 * 
 */

 class Products extends Controller {
    public function index() {
        echo "Products Controller -> index Method";
        $this->view('products');
    }
}