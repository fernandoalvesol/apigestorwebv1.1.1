<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeControlller extends Controller
{
    public function index(){
        return view("home");
    }
}
