<?php

/**
 * User Model
 * 
 * @author Michał Borowiec <michal@cursed.pl>
 * @version 1.0 
 * @package app/model
 * 
 */

class User {

    use Model;
    protected string $table = 'test';
    protected array $columns = [
        'age',

    ];


}