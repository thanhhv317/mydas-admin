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
        return view('pages.accounts.list-tele');
    }

    public function showListAccountTele(Request $reques) {
        $result = api('admin/account-tele', 'GET');
        return $result;
    }


}
