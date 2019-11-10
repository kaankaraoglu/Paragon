<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    public static function heim(){
        return view('heim');
    }

    public static function dashboard(){
        if (CommonFunctions::sessionIsValid()){
            return view('dashboard');
        } else {
            return self::heim();
        }
    }
}
