<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;


class AgencyController extends Controller
{
    public function index() {
        $result = \api('admin/total-member-in-agency', 'GET');

        $memInAgency = isset($result['data']) ? $result['data'] : ''; 

        return view('pages.agencies.list', ['memInAgency' => $memInAgency]);
    }

    public function create() {
        return view('pages.agencies.add');
    }

    public function postCreate(Request $request) {
        $param      = $request->all();

        $validation = Validator::make($param, 
        [
            'name'          => 'required',
            'title'         => 'required',
            'amount'        => 'required',
            'username'      => 'required',
            'password'      => 'required',
            'repassword'    => 'required|same:password',
            'domain'        => 'required',
            'logo'          => 'required'
        ],
        [
            'required'  => 'Các trường không được để trống!',
            'same'      => 'Mật khẩu không khớp nhau'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $title      = isset($param['title']) ? $param['title'] : '';
        $name       = isset($param['name']) ? $param['name'] : '';
        $amount     = isset($param['amount']) ? $param['amount'] : '';
        $username   = isset($param['username']) ? $param['username'] : '';
        $password   = isset($param['password']) ? $param['password'] : '123456';
        $domain     = isset($param['domain']) ? $param['domain'] : '';


        if($request->hasFile('logo')){
            $date               = date_create();
            $currentTimestamp   = date_timestamp_get($date);
            $file_name          = $currentTimestamp . $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move('resources/uploads/agency-logo/', $file_name);
            $avatar             = asset('/resources/uploads/agency-logo/' . $file_name);
        }
        
        $logo = isset($avatar) ? $avatar : '';
        $data = [
            'username'      => $username,
            'password'      => $password,
            'fullname'      => $name,
            'logo'          => $logo,
            'limit_user'    => $amount,
            'title'         => $title,
            'domain'        => $domain
        ];
        // dd(session('user_data')['token']);
        // dd($data);

        $result = api('admin/agency', 'POST', $data);

        if (!$result['status']) {
            return redirect()->back()->with("error", $result['code'])->withInput($request->input());
        } 
        return  redirect()->back()->with('message', 'success');
    }

    public function getList(Request $request) {

        $param = $request->all();
        
        $page = isset($param['pagination']['page']) ? $param['pagination']['page'] : 1;
        $perpage = isset($param['pagination']['perpage']) ? $param['pagination']['perpage'] : 10;

        //  Get value to search 
        $searchValue = isset($param['query']['generalSearch']) ? $param['query']['generalSearch'] : '';
        
        $dataList = [
            "page" => $page,
            "limit" => $perpage,
            "fullname" => $searchValue
        ];

        $result = api('admin/agency', 'GET', $dataList);
        if ($result['status']) {
            $total = isset($result['total']) ? $result['total'] : count($result['data']);
            $object = [
                "meta" => [
                    "page" => $page,
                    "pages" => ceil($total / $perpage),
                    "perpage"   => $perpage,
                    "total"     => $total,
                    "request"   => $param 
                ],
                "data"  => $result['data']
            ];
        }

        return ($object);
    }

    public function update(Request $request) {
        $result = api('admin/agency', 'GET', ['id' => $request->id]);
        if ($result['status'] == false) {
            return redirect()->back()->with("error", $result['code'])->withInput($request->input());
        }
        $agency = isset($result['data']) ? $result['data'][0] : '';
        $id = isset($request->id) ? $request->id : '';
        return view('pages.agencies.update', ['agency' => $agency, 'id' => $id]);
    }
    
    public function postUpdate (Request $request) {
        $param      = $request->all();

        $validation = Validator::make($param, 
        [
            'name'      => 'required',
            'title'     => 'required',
            'username'  => 'required',
            'domain'    => 'required',
            'amount'    => 'required',
        ],
        [
            'required'  => 'Các trường không được để trống!',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $title      = isset($param['title']) ? $param['title'] : '';
        $name       = isset($param['name']) ? $param['name'] : '';
        $username   = isset($param['username']) ? $param['username'] : '';
        $domain     = isset($param['domain']) ? $param['domain'] : '';
        $amount     = isset($param['amount']) ? $param['amount'] : '';

        if($request->hasFile('logo')){
            $date               = date_create();
            $currentTimestamp   = date_timestamp_get($date);
            $file_name          = $currentTimestamp . $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move('resources/uploads/agency-logo/', $file_name);
            $avatar             = asset('/resources/uploads/agency-logo/' . $file_name);
        }
        
        $logo = isset($avatar) ? $avatar : $param['image'];
        $id   = (int)$param['id'];
        $data = [
            'Id'            => $id,
            'username'      => $username,
            'fullname'      => $name,
            'logo'          => $logo,
            'title'         => $title,
            'domain'        => $domain,
            'limit_user'    => $amount,
        ];

        // dd($data);

        $result = api('admin/agency', 'PUT', $data);

        if (!$result['status']) {
            return redirect()->back()->with("error", $result['code'])->withInput($request->input());
        } 
        return  redirect()->back()->with('message', 'success');
    }

    public function deleteMe(Request $request) {
        $id = $request->id;
        $data = ['id' => $id];
        $result = api('admin/agency', 'DELETE', $data);
        return $result;
    }
}
