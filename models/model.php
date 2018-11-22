<?php
namespace Models;
use \Models\Database;

class Model{
    static private $fillable;
    static private $tablename;

    public static function find($request) {
        $db = new Database();
        if(is_object($request)) {
            // $where = "email='asdf' AND password='werwr'";
            $where = '';
            $first = true;
            foreach($request as $key => $value) {
                if(!$first) $where .= " AND ";
                $where .= "$key='$value'";
                $first = false;
            }
            $sql = "SELECT * FROM " . static::$tablename . " WHERE $where LIMIT 1";
            $result = mysqli_query($db->conn, $sql);
        } else {
            $id = $request;
            $result = mysqli_query($db->conn, "SELECT * FROM " . static::$tablename . " WHERE id=" . $id);
        }
        $row = mysqli_fetch_assoc($result);
        if($row == null) return false;
        $rr = new static();
        $rr->fill($row);
        return $rr;
    }
    
    public static function findAll($request = false) {
        
        $db = new Database();
        if($request) {
            $where = '';
            $first = true;
            foreach($request as $key => $value) {
                if(!$first) $where .= " AND ";
                $where .= "$key='$value'";
                $first = false;
            }
        } else {
            $where = '1';
        }

        $result = mysqli_query($db->conn, "SELECT * FROM " . static::$tablename . " WHERE $where");
        $rlt = array();
        while($row = mysqli_fetch_assoc($result)) {
            $rr = new static();
            $rr->fill($row);
            array_push($rlt, $rr);
        }
        return $rlt;
    }

    public function fill($fields) {
        if(is_object($fields)) {
            if(isset($fields->id)) $this->id = $fields->id;
            foreach(static::$fillable as $key) {
                if(isset($fields->$key)) $this->$key = $fields->$key;
            }
        } else {
            if(isset($fields['id'])) $this->id = $fields['id'];
            foreach(static::$fillable as $key) {
                if(isset($fields[$key])) $this->$key = $fields[$key];
            }
        }
        
    }

    public function save() {
        $db = new Database();
        if(isset($this->id)) {
            $first = true;
            $set = '';
            foreach(static::$fillable as $key) {
                if(isset($this->$key)) {
                    if(!$first) $set .= ", ";
                    $set .= $key . "='" . $this->$key . "'";
                    $first = false;
                }
            }
            $sql = "UPDATE " . static::$tablename . " SET $set WHERE id=" . $this->id;
            $result = mysqli_query($db->conn, $sql);
        } else {
            $first = true;
            $keys = '';
            $values = '';
            foreach(static::$fillable as $key) {

                if(isset($this->$key)) {
                    if(!$first) { $keys .= ","; $values .= ","; }
                    $keys .= $key;
                    $values .= "'" . $this->$key . "'";
                    $first = false;
                }
            }
            $sql = "INSERT INTO " . static::$tablename . " ($keys) VALUES ($values)";
            $result = mysqli_query($db->conn, $sql);

            $id = mysqli_insert_id($db->conn);
            $sql = "SELECT * FROM " . static::$tablename . " WHERE id=" . $id;
            $result = mysqli_query($db->conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $this->fill($row);
        }
        
    }
}