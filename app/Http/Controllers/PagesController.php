<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    public function heim(){
        return view('heim');
    }

    public function dashboard(){
        return view('dashboard');
    }
}
