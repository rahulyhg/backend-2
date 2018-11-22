<?php
namespace Models;
use \PDO;

// used to get mysql database connection
class Database{
 
    // specify your own database credentials
    private $host = "localhost:3306";
    private $db_name = "sym_db";
    private $username = "root";
    private $password = "";
    public $conn;
 
    // get the database connection
    function  __construct(){
 
        $this->conn = null;
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->db_name);
        if(! $this->conn ) {
            die('Could not connect: ' . mysqli_error());
        }
 
        return $this->conn;
    }

    public function reset() {
        $conn = $this->conn;
        mysqli_query($conn, 'SET foreign_key_checks = 0');
        
        if ($result = mysqli_query($conn, "SHOW TABLES"))
        {
            while($row = mysqli_fetch_array($result))
            {
                mysqli_query($conn, 'DROP TABLE IF EXISTS '.$row[0]);
            }
        }
        mysqli_query($conn, 'SET foreign_key_checks = 1');
        
        $sql ="CREATE table users(
            id INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR( 100 ) NOT NULL, 
            email VARCHAR( 100 ) NOT NULL,
            password VARCHAR( 100 ) NOT NULL, 
            role VARCHAR(10) DEFAULT 'user',
            creation_date DATE NOT NULL, 
            last_access DATE,
            active VARCHAR(4) DEFAULT 'No');";
        $result = mysqli_query($conn, $sql)  or die (mysqli_error($conn)); 
        $cur_date = date("Y-m-d");
        $result = mysqli_query($conn, "INSERT INTO users VALUES (1, 'admin', 'admin@admin.com', 'admin', 'admin', '$cur_date', null, 'Yes')")  or die (mysqli_error($conn)); 

        $sql ="CREATE table syms(
            id INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
            mrk VARCHAR(10) NOT NULL, 
            sym VARCHAR( 10 ) NOT NULL,
            active VARCHAR(4) DEFAULT 'No');";
        $result = mysqli_query($conn, $sql)  or die (mysqli_error($conn)); 

        $sql ="CREATE table data(
            id INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
            date DATE NOT NULL, 
            userid VARCHAR(50) NOT NULL,
            sym VARCHAR(50) NOT NULL,
            bp VARCHAR(50) NOT NULL,
            tp VARCHAR(50) NOT NULL,
            sp VARCHAR(50) NOT NULL);";
        $result = mysqli_query($conn, $sql)  or die (mysqli_error($conn)); 
    }
}
?>
