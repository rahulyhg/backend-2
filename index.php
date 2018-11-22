<?php 
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
    
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE");
        }
    
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        }
    
        exit(0);
    }
    require('./vendor/autoload.php');
    require('./config/core.php');

    require('./models/model.php');
    require('./models/db.php');
    require('./models/user.php');
    require('./models/sym.php');
    require('./models/data.php');

    require('./controllers/auth.php');
    require('./controllers/user.php');
    require('./controllers/sym.php');
    require('./controllers/data.php');
    
    require('./routes/api.php');