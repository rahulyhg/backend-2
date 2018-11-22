<?php
namespace Controllers;
use \Models\Data;
class DataController{
    public static function getAllData() {
        $data = Data::findAll();
        return $data;
    }

    public static function addData($request) {
        $data = new Data();
        $request->date = date('Y-m-d');
        $data->fill($request);
        $data->save();
        return $data;
    }
}