<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class AccountController extends Controller
{
    public function index()
    {

        return view('pages.accounts.list');
    }

    public function getList(Request $request)
    {

        $param = $request->all();

        $page       = isset($param['pagination']['page']) ? $param['pagination']['page'] : 1;
        $perpage    = isset($param['pagination']['perpage']) ? $param['pagination']['perpage'] : 10;

        //  Get value to search 
        $searchValue = isset($param['query']['generalSearch']) ? $param['query']['generalSearch'] : '';

        $dataList = [
            "limit"     => $perpage,
            "perpage"   => $page - 1,
            "agency"    => $searchValue
        ];

        $result = api('admin/account', 'GET', $dataList);
        if ($result['status']) {
            $total  = isset($result['total']) ? $result['total'] : count($result['data']);
            $object = [
                "meta" => [
                    "page"      => $page,
                    "pages"     => ceil($total / $perpage),
                    "perpage"   => $perpage,
                    "total"     => $total,
                ],
                "data" => $result['data']
            ];
        }
        return ($object);
    }

    public function create()
    {
        $agency = $this->getListAgency();
        return view('pages.accounts.add', ['agency' => $agency]);
    }

    public function postCreate(Request $request)
    {
        $param = $request->all();

        $validation = Validator::make($param,
            [
                'username'      => 'required',
                'password'      => 'required',
                'repassword'    => 'required|same:password',
            ],
            [
                'required'      => 'Các trường không được để trống!',
            ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $username   = isset($param['username']) ? $param['username'] : '';
        $password   = isset($param['password']) ? $param['password'] : '123456';
        $phone      = isset($param['phone']) ? $param['phone'] : '';
        $email      = isset($param['email']) ? $param['email'] : '';
        $agency     = isset($param['list-agency']) ? $param['list-agency'] : '';

        $data = [
            'username'  => $username,
            'password'  => $password,
            'phone'     => $phone,
            'email'     => $email,
            'parent'    => $agency
        ];

        $result = \api('admin/account', 'POST', $data);
        if (!$result['status']) {
            return redirect()->back()->with("error", $result['code'])->withInput($request->input());
        }
        return redirect()->back()->with('message', 'success');
    }

    public function update(Request $request)
    {
        $result = \api('admin/account', 'GET', ['id' => $request->id]);
        if ($result['status'] == false) {
            return redirect()->back()->with("error", $result['code'])->withInput($request->input());
        }
        $account = isset($result['data']) ? $result['data'][0] : '';
        $id      = isset($request->id) ? $request->id : '';
        $agency  = $this->getListAgency();
        return view('pages.accounts.update', ['account' => $account, 'id' => $id, 'agency' => $agency]);
    }

    public function postUpdate(Request $request)
    {
        $param = $request->all();

        $validation = Validator::make($param,
            [
                'repassword' => 'same:password',
            ],
            [
                'same'       => 'Mật khẩu không khớp',
            ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $password   = isset($param['password']) ? $param['password'] : null;
        $phone      = isset($param['phone']) ? $param['phone'] : '';
        $email      = isset($param['email']) ? $param['email'] : '';
        $agency     = isset($param['list-agency']) ? $param['list-agency'] : '';
        $id         = isset($param['id']) ? $param['id'] : '';

        $data = [
            'password'  => $password,
            'phone'     => $phone,
            'email'     => $email,
            'parent'    => $agency,
            'id'        => $id
        ];

        $result = \api('admin/account', 'PUT', $data);
        if (!$result['status']) {
            return redirect()->back()->with("error", $result['code'])->withInput($request->input());
        }
        return redirect()->back()->with('message', 'success');
    }

    public function deleteMe(Request $request)
    {
        if ($request->ajax()) {
            $id     = $request->id;
            $data   = ['id' => $id];
            $result = api('admin/account', 'DELETE', $data);
            return $result;
        }
    }

    // show list telegram of a user

    public function showListTeleOfUser(Request $request)
    {
        $result = \api('admin/account', 'GET', ['id' => $request->id]);
        if ($result['status'] == false) {
            return redirect()->back()->with("error", $result['code'])->withInput($request->input());
        }
        $account = isset($result['data']) ? $result['data'][0] : '';

        return view('pages.accounts.list-of-user', ['id' => $request->id, 'account' => $account]);
    }

    public function postShowListTeleOfUser(Request $request)
    {
        $param      = $request->all();
        $page       = isset($param['pagination']['page']) ? $param['pagination']['page'] : 1;
        $perpage    = isset($param['pagination']['perpage']) ? $param['pagination']['perpage'] : 10;

        //  Get value to search 
        $searchValue = isset($param['query']['generalSearch']) ? $param['query']['generalSearch'] : '';

        $dataList = [
            "idaccount" => $request->id,
            "limit"     => $perpage,
            "perpage"   => $page - 1,
            "agency"    => $searchValue
        ];

        $result = api('admin/account-tele', 'GET', $dataList);
        if ($result['status']) {
            $total = isset($result['total']) ? $result['total'] : count($result['data']);
            $object = [
                "meta" => [
                    "page"      => $page,
                    "pages"     => ceil($total / $perpage),
                    "perpage"   => $perpage,
                    "total"     => $total,
                ],
                "data" => $result['data']
            ];
        }
        return ($object);
    }

    //Show list telegram of an agency

    public function showListTeleOfAgency (Request $request) {
        $id = $request->id;
        return view('pages.accounts.list-of-agency', ['id' => $id]);
    }

    public function postShowListTeleOfAgency(Request $request) {
        $param      = $request->all();
        $page       = isset($param['pagination']['page']) ? $param['pagination']['page'] : 1;
        $perpage    = isset($param['pagination']['perpage']) ? $param['pagination']['perpage'] : 10;

        //  Get value to search 
        $searchValue = isset($param['query']['generalSearch']) ? $param['query']['generalSearch'] : '';

        $dataList = [
            "limit"     => $perpage,
            "perpage"   => $page - 1,
            "agency"    => $searchValue,
            "idAgency"  => isset($request->id) ? $request->id : ''
        ];

        $result = api('admin/account-tele', 'GET', $dataList);

        if ($result['status']) {
            $total = isset($result['total']) ? $result['total'] : count($result['data']);
            $object = [
                "meta" => [
                    "page"      => $page,
                    "pages"     => ceil($total / $perpage),
                    "perpage"   => $perpage,
                    "total"     => $total,
                ],
                "data" => $result['data']
            ];
        }

        return ($object);
    }

    //ACCOUNT TELE

    public function listAccountTele()
    {
        $agency = $this->getListAgency();
        return view('pages.accounts.list-tele', ['agency' => $agency]);
    }

    public function showListAccountTele(Request $request)
    {
        $param      = $request->all();
        $page       = isset($param['pagination']['page']) ? $param['pagination']['page'] : 1;
        $perpage    = isset($param['pagination']['perpage']) ? $param['pagination']['perpage'] : 10;

        //  Get value to search 
        $searchValue = isset($param['query']['generalSearch']) ? $param['query']['generalSearch'] : '';

        $dataList = [
            "limit"     => $perpage,
            "perpage"   => $page - 1,
            "agency"    => $searchValue
        ];

        $result = api('admin/account-tele', 'GET', $dataList);

        if ($result['status']) {
            $total = isset($result['total']) ? $result['total'] : count($result['data']);
            $object = [
                "meta" => [
                    "page"      => $page,
                    "pages"     => ceil($total / $perpage),
                    "perpage"   => $perpage,
                    "total"     => $total,
                ],
                "data" => $result['data']
            ];
        }

        return ($object);
    }

    public function shareToAgency(Request $request)
    {
        if ($request->ajax()) {
            $listAccount = $request->dataAccount;

            $data = [
                'id'        => $listAccount,
                'agency'    => $request->listAgency
            ];
            $result = api('admin/share-to-agency', 'PUT', $data);
            return $result;
        }
    }

    // GET LIST AGENCY
    public function getListAgency()
    {
        $result = api('admin/agency', 'GET');
        if ($result['status'] == false) {
            return redirect()->back()->with("error", $result['code'])->withInput($request->input());
        }
        $agency = isset($result['data']) ? $result['data'] : '';
        return $agency;
    }
}