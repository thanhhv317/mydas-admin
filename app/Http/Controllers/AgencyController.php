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
        dd($request->all());
    }
}
