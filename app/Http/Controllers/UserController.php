<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

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

    //PAGE LOGIN FOR AGENCY
    // public function loginAGency(Request $request) {
    //     $url = url()->full();
    //     $arr = explode('/', $url);
    //     $domain = $arr[count($arr)-2];
    //     $data = [
    //         'domain' => $domain
    //     ];
    //     $result = api('admin/agency', 'GET', $data);

    //     if ($result['status']) {
    //         $agency = isset($result['data']) ? $result['data'][0] : '';
    //         return view('layouts.login2', ['agency' => $agency]);
    //     }
    //     return \abort(404);
    // }

    public function showProfile() {
        $result = api('admin/profile', 'GET', []);
        if (!$result['status']) {
            return redirect()->back()->with("error", $result['code'])->withInput($request->input());
        } 

        $data = $result['data'];
        
        return view('pages.users.profile', ['data' => $data]);
    }

    public function updateProfile(Request $request) {
        $param      = $request->all();
        $validation = Validator::make($param, 
        [
            'fullname'      => 'required',
            'domain'        => 'required',
            'title'         => 'required',
            'phone'         => 'required',
            'email'         => 'required',
            'gender'        => 'required',
        ],
        [
            'required'  => 'Các trường không được để trống!',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $title      = isset($param['title']) ? $param['title'] : '';
        $fullname   = isset($param['fullname']) ? $param['fullname'] : '';
        $phone      = isset($param['phone']) ? $param['phone'] : '';
        $email      = isset($param['email']) ? $param['email'] : '';
        $gender     = isset($param['gender']) ? $param['gender'] : '1';
        $domain     = isset($param['domain']) ? $param['domain'] : '';


        if($request->hasFile('logo')){
            $date               = date_create();
            $currentTimestamp   = date_timestamp_get($date);
            $file_name          = $currentTimestamp . $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move('resources/uploads/agency-logo/', $file_name);
            $avatar             = asset('/resources/uploads/agency-logo/' . $file_name);
        }
        
        $logo = isset($avatar) ? $avatar : $param['image'];

        $data = [
            'email'         => $email,
            'phone'         => $phone,
            'fullname'      => $fullname,
            'logo'          => $logo,
            'gender'        => $gender,
            'title'         => $title,
            'domain'        => $domain
        ];

        $result = api('admin/profile', 'PUT', $data);
        if (!$result['status']) {
            return redirect()->back()->with("error", $result['code'])->withInput($request->input());
        } 
        return  redirect()->back()->with('message', 'success');
    }

    public function updatePassword(Request $request) {
        $param = $request->all();
        $validation = Validator::make($param, 
        [
            'currentPass'   => 'required',
            'password'      => 'required',
            'rePassword'    => 'required|same:password',
        ],
        [
            'required'  => 'Các trường không được để trống!',
            'same'      => 'Mật khẩu mới phải khớp nhau'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $data = [
            "password"      => $param['currentPass'],
            "newpassword"   => $param['password']
        ];

        $result = api('admin/password', 'PUT', $data);
        if (!$result['status']) {
            return redirect()->back()->with("error", $result['code'])->withInput($request->input());
        } 
        return  redirect()->back()->with('message', 'success');
    }
}
