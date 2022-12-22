<?php

namespace Core;

defined('ROOTPATH') OR die('ACCES DENIED');
/**
 * Session Class
 * 
 * @author Michał Borowiec <michal@cursed.pl>
 * @version 1.0 
 * @package Core\Session
 * 
 */

class Session {

    private function sessionStart() : int {
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return true;
    }

    public function sessionSet(mixed $keys, mixed $value = '') : int {
        $this->sessionStart();
        if(is_array($keys)) {
            foreach ($keys as $key => $value) {
                $_SESSION['APP'][$key] = $value;
            }
            return true;
        }
        $_SESSION['APP'][$keys] = $value;
    }

    public function sessionGet(string $key, mixed $default = '') : mixed {
        $this->sessionStart();
        if(isset($_SESSION['APP'][$key])) {
            return $_SESSION['APP'][$key];
        }
        return $default;
    }

    public function sessionClear(string $key, mixed $default = '') : mixed {
        $this->sessionStart();
        if(!empty($_SESSION['APP'][$key])) {
            $value = $_SESSION['APP'][$key];
            unset($_SESSION['APP'][$key]);
            return $value;
        }
        return $default;
    }

    public function sessionAll() : mixed {
        $this->sessionStart();
        if(isset($_SESSION['APP'])) {
            return $_SESSION['APP'];
        }
        return [];
    }

    public function userAuth(mixed $userRow) : int {
        $this->sessionStart();
        $_SESSION['USER'] = $userRow;
        return false;
    }

    public function userLogout() : int {
        $this->sessionStart();
        if(!empty($_SESSION['USER'])) {
            unset($_SESSION['USER']);
        }
        return false;
    }

    public function userCheckLogin() : bool {
        $this->sessionStart();
        if(!empty($_SESSION['USER'])) {
            return true;
        }
        return false;
    }

    public function user(string $key = '', mixed $default = '') : mixed {
        $this->sessionStart();
        if(empty($key) && !empty($_SESSION['USER'])) {
            return $_SESSION['USER'];
        } elseif (!empty($_SESSION['USER']->$key)) {
            return $_SESSION['USER']->$key;
        }
        return $default;
    }

}