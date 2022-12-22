<?php

namespace Core;

defined('ROOTPATH') OR die('ACCES DENIED');
/**
 * Session Class
 * 
 * @author Michał Borowiec <michal@cursed.pl>
 * @version 1.0 
 * @package Core\Request
 * 
 */

class Request {
    public function requestMethod() : string {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function requestPosted() : bool {
        if($_SERVER['REQUEST_METHOD'] === "POST" && count($_POST) > 0) {
            return true;
        }
        return false;
    }

    public function requestPost(string $key = '', mixed $default = '') : mixed {
        if(empty($key)) {
            return $_POST;
        } elseif(isset($_POST[$key])) {
            return $_POST[$key];
        }
        return $default;
    }

    public function requestFile(string $key = '', mixed $default = '') : mixed {
        if(empty($key)) {
            return $_FILES;
        } elseif(isset($_FILES[$key])) {
            return $_FILES[$key];
        }
        return $default;
    }

    public function requestGet(string $key, mixed $default = '') :mixed {
        if(empty($key)) {
            return $_GET;
        } elseif(isset($_GET[$key])) {
            return $_GET[$key];
        }
        return $default;
    }

    public function requestInput(string $key, mixed $default = '') : mixed {
        if(isset($_REQUEST[$key])) {
            return$_REQUEST[$key];
        }
        return $default;
    }

    public function requestAll() : mixed {
        return $_REQUEST;
    }
}