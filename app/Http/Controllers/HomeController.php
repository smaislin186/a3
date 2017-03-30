<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
    *   GET /
    */
    public function __invoke(){
            return view('home');
    }
}
