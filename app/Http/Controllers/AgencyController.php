<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AgencyController extends Controller
{
    public function index() {
        return view('pages.agencies.list');
    }

    public function create() {
        return view('pages.agencies.add');
    }

    public function postCreate(Request $request) {
        $param = $request->all();
        $title = isset($param['title']) ? $param['title'] : '';
        $name = isset($param['name']) ? $param['name'] : '';
        $amount = isset($param['amount']) ? $param['amount'] : '';

        if($request->hasFile('logo')){
            $date = date_create();
            $currentTimestamp = date_timestamp_get($date);
            $file_name = $currentTimestamp . $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move('resources/uploads/agency-logo/',$file_name);
    	}
        $logo = asset('/resources/uploads/agency-logo/'.$file_name);
        dd($logo);
    }
}
