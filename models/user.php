<?php
namespace Models;
use \Models\Database;
use \Models\Model;

class User extends Model{
    static protected $tablename = "users";
    static protected $fillable = ["username", "email", "password", "role", "creation_date", "last_access", "active"];
}