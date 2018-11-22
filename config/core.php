<?php
// show error reporting
error_reporting(E_ALL);
 
// set your default time-zone
date_default_timezone_set('Asia/Manila');
 

// variables used for jwt
define('SECURITE_KEY', "SYM_PROJECT");
define('ISS', "http://example.org");  //issuer
define('AUD', "http://localhost:4200");  //audience
define('IAT', 1356999524);  //issued at
define('NBF', 1357000000);  //not before

?>