<?php
namespace Models;
use \Models\Model;

class Sym extends Model{
    static protected $fillable = ["mrk", "sym", "active"];
    static protected $tablename = "syms";
}