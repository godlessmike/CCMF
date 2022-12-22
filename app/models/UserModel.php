<?php

namespace Models;

defined('ROOTPATH') OR die('ACCES DENIED');

/**
 * User Model
 * 
 * @author Michał Borowiec <michal@cursed.pl>
 * @version 1.0 
 * @package Model\USerModel
 * 
 */

class User {
    use Model;

    protected string $table = 'test';
    protected array $columns = [
        'age',

    ];


}