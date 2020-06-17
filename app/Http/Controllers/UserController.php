<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login () {
        return view('layouts.login');
    }

    public function postLogin(Request $request) {
        if ($request->ajax()) {
            $username = $request->username;
            $password = $request->password;

            $data = [
                "username"  => $username,
                "password"  => $password
            ];

            $result = api("admin/login", 'POST', $data);
            
            if($result['status'] == true){
                session(['user_data' => $result['data']]);
                return true;
            }
            else {
                return false;
            }
        }
    }

    public function logout() {
        session()->flush();
        return redirect()->route('users.get.login');
    }

    public function dashboard() {
        return view('pages.users.dashboard');
    }
}
