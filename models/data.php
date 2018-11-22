<?php
namespace Models;

use \Models\Model;

class Data extends Model{
    static protected $tablename = 'data';
    static protected $fillable = ["userid", "sym", "date", "bp", "tp", "sp"];
    
}