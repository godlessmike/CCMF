<?php

/**
 * Model Class
 * 
 * @author Michał Borowiec <michal@cursed.pl>
 * @version 1.0 
 * @package app
 * 
 */

trait Model {
    use Database;

    protected int $limit = 5;
    protected int $offset = 0;
    protected string $orderDirect = "desc";
    protected string $orderColumn = "id";

    public function dbWhereRow(mixed $data, mixed $not = []) {
        $keys = array_keys($data);
        $keysNot = array_keys($not);
        $where = "";

        foreach($keys as $key) {
            $where .= $key . " = :" . $key . " && ";
        }
        foreach($keysNot as $key) {
            $where .= $key . " != :" . $key . " && ";
        }

        $where = trim($where, " && ");
        $where .= " ORDER BY $this->orderColumn $this->orderDirect LIMIT $this->limit OFFSET $this->offset";
        $query = "SELECT * FROM $this->table WHERE $where";
        $data = array_merge($data, $not);
        return $this->dbQuery($query, $data);
    }

    public function dbFirstRow(mixed $data, mixed $not = []) {
        $keys = array_keys($data);
        $keysNot = array_keys($not);
        $where = "";

        foreach($keys as $key) {
            $where .= $key . " = :" . $key . " && ";
        }
        foreach($keysNot as $key) {
            $where .= $key . " != :" . $key . " && ";
        }

        $where = trim($where, " && ");
        $where .= " ORDER BY $this->orderColumn $this->orderDirect LIMIT $this->limit OFFSET $this->offset";
        $query = "SELECT * FROM $this->table WHERE $where";
        $data = array_merge($data, $not);
        $result =  $this->dbQuery($query, $data);
        
        if($result) {
            return $result[0];
        }

        return false;
    }

    public function dbInsert(mixed $data) {
        if(!empty($this->columns)) {
            foreach($data as $key => $value) {
                if(!in_array($key, $this->columns)) {
                    unset($data[$key]);
                }
            }
        }
        $keys = array_keys($data);
        $query = "INSERT INTO $this->table (" . implode(", " , $keys) . ") VALUES (:" . implode(", :" , $keys) . ")";
        $this->dbQuery($query, $data);
        return false;
    }

    public function dbUpdate(mixed $row, array $data = [], string $column = 'id') {
        if(!empty($this->columns)) {
            foreach($data as $key => $value) {
                if(!in_array($key, $this->columns)) {
                    unset($data[$key]);
                }
            }
        }
        $keys = array_keys($data);
        $update = "";

        foreach($keys as $key) {
            $update .= $key . " = :" . $key .', ';
        }

        $update = trim($update, ', ');
        $data[$column] = $row;
        $query = "UPDATE $this->table SET $update WHERE $column = :$column";
        $this->dbQuery($query, $data);
        return false;
    }

    public function dbDelete(mixed $row, string $column = 'id') {
        $data[$column] = $row;
        $query = "DELETE FROM $this->table WHERE $column = :$column ";
        $this->dbQuery($query, $data);
        return false;
    }

    public function dbAllRows() {
        $query = "SELECT * FROM $this->table  ORDER BY $this->orderColumn $this->orderDirect  LIMIT $this->limit OFFSET $this->offset";
        $result = $this->dbQuery($query);
        return $result;
    }

}