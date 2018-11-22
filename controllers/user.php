<?php
namespace Controllers;
use \Models\User;

class UserController {
    public static function getAllUsers() {
        $users = User::findAll(array("role" => "user"));
        return $users;
    }

    public static function addUser($request) {
        $user = new User();
        $request->creation_date = date("Y-m-d");
        $user->fill($request);
        $user->save();
        return $user;
    }

    public static function convertActivation($request) {
        $user = User::find($request->id);

        if($user->active == 'Yes') $user->active = 'No'; else $user->active = 'Yes';
        $user->save();
        return $user;
    }

    public static function editUser($request) {
        $user = User::find($request->id);
        $user->fill($request);
        $user->save();
        return $user;
    }
}