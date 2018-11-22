<?php
namespace Controllers;

use \Models\Sym;

class SymController{
    public static function getAllSyms() {
        $syms = Sym::findAll();
        return $syms;        
    }

    public static function addSym($request) {
        $sym = new Sym();
        $sym->fill($request);
        $sym->save();
        return $sym;
    }

    public static function convertActivation($request) {
        $sym = Sym::find($request->id);
        if($sym->active == 'Yes') $sym->active = 'No'; else $sym->active = 'Yes';
        $sym->save();
        return $sym;
    }

}