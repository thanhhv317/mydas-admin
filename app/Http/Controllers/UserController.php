<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login () {
        return view('layouts.login');
    }

    public function postLogin() {
        
    }
}
