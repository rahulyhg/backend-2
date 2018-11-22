<?php
use \Models\Database;
use \Controllers\AuthController;
use \Controllers\UserController;
use \Controllers\SymController;
use \Controllers\DataController;

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if($method == 'POST') {
    switch($uri) {
        case '/reset':
            $db = new Database();
            $db->reset();
            echo '{"message":"Successfully Reset."}';
            break;
        case '/api/auth/login':
            $json_str = file_get_contents('php://input');
            $json_obj = json_decode($json_str);
            AuthController::login($json_obj);
            break;
        case '/api/auth/logout':
            echo json_encode(array("message" => "Logout successfully."));
            break;
        case '/api/add-user': 
            $json_str = file_get_contents('php://input');
            $json_obj = json_decode($json_str);
            $user = UserController::addUser($json_obj);
            echo json_encode($user);
            break;
        case '/api/edit-user':
            $json_str = file_get_contents('php://input');
            $json_obj = json_decode($json_str);
            $user = UserController::editUser($json_obj);
            echo json_encode($user);
            break;
        case '/api/user/convert-activation':
            $json_str = file_get_contents('php://input');
            $json_obj = json_decode($json_str);
            $user = UserController::convertActivation($json_obj);
            echo json_encode($user);
            break;
        case '/api/add-sym':
            $json_str = file_get_contents('php://input');
            $json_obj = json_decode($json_str);
            $sym = SymController::addSym($json_obj);
            echo json_encode($sym);
            break;
        case '/api/sym/convert-activation':
            $json_str = file_get_contents('php://input');
            $json_obj = json_decode($json_str);
            $sym = SymController::convertActivation($json_obj);
            echo json_encode($sym);
            break;
        case '/api/add-data':
            $json_str = file_get_contents('php://input');
            $json_obj = json_decode($json_str);
            $data = DataController::addData($json_obj);
            echo json_encode($data);
            break;
    }
}
if($method == 'GET') {
    switch($uri) {
        case '/api/users':
            $users = UserController::getAllUsers();
            echo json_encode($users);
            break;
        case '/api/syms':
            $syms = SymController::getAllSyms();
            echo json_encode($syms);
            break;
        case '/api/data': 
            $data = DataController::getAllData();
            echo json_encode($data);
            break;
    }
}