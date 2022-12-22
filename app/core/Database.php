<?php

defined('ROOTPATH') OR die('ACCES DENIED');

/**
 * Database Class
 * 
 * @author Michał Borowiec <michal@cursed.pl>
 * @version 1.0 
 * @package app
 * 
 */

trait Database {
    private function dbConnect() {
        $connection = new PDO(DBDRVR . ":hostname=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
        if($connection)
            return $connection;
    }

    public function dbQuery(string $query, array $data = []) {
        $connection = $this->dbConnect();
        $statement = $connection->prepare($query);
        $check = $statement->execute($data);
        if($check) {
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            if(is_array($result) && count($result)) {
                return $result;
            }
        }
        return false;
    }

    public function dbGetRow(string $query, array $data = []) {
        $connection = $this->dbConnect();
        $statement = $connection->prepare($query);
        $check = $statement->execute($data);
        
        if($check) {
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            if(is_array($result) && count($result)) {
                return $result[0];
            }
        }
        else return false;
    }
}