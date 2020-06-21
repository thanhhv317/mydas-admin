<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index() {
        
        return view('pages.accounts.list');
    }

    public function getList(Request $request) {
        
        $param = $request->all();
        
        $page = isset($param['pagination']['page']) ? $param['pagination']['page'] : 1;
        $perpage = isset($param['pagination']['perpage']) ? $param['pagination']['perpage'] : 10;

        //  Get value to search 
        $searchValue = isset($param['query']['generalSearch']) ? $param['query']['generalSearch'] : '';
        
        $dataList = [
            "limit" => $perpage,
            "perpage" => $page - 1,
            "agency" => $searchValue
        ];

        $result = api('admin/account', 'GET', $dataList);
        if ($result['status']) {
            $total = isset($result['total']) ? $result['total'] : count($result['data']);
            $object = [
                "meta" => [
                    "page" => $page,
                    "pages" => ceil($total / $perpage),
                    "perpage"   => $perpage,
                    "total"     => $total,
                ],
                "data"  => $result['data']
            ];
        }

        return ($object);
    }

    //TELE

    public function listAccountTele() { 
        $result = api('admin/agency', 'GET');
        if ($result['status'] == false) {
            return redirect()->back()->with("error", $result['code'])->withInput($request->input());
        }
        $agency = isset($result['data']) ? $result['data'] : '';
        
        return view('pages.accounts.list-tele', ['agency' => $agency]);
    }

    public function showListAccountTele(Request $request) {
        $result = api('admin/account-tele', 'GET');
        
        $param = $request->all();
        
        $page = isset($param['pagination']['page']) ? $param['pagination']['page'] : 1;
        $perpage = isset($param['pagination']['perpage']) ? $param['pagination']['perpage'] : 10;

        //  Get value to search 
        $searchValue = isset($param['query']['generalSearch']) ? $param['query']['generalSearch'] : '';
        
        $dataList = [
            "limit" => $perpage,
            "perpage" => $page - 1,
            "agency" => $searchValue
        ];

        $result = api('admin/account-tele', 'GET', $dataList);
        if ($result['status']) {
            $total = isset($result['total']) ? $result['total'] : count($result['data']);
            $object = [
                "meta" => [
                    "page" => $page,
                    "pages" => ceil($total / $perpage),
                    "perpage"   => $perpage,
                    "total"     => $total,
                ],
                "data"  => $result['data']
            ];
        }

        return ($object);
    }


}
