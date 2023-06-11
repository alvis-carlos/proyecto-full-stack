<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardAdmin extends Controller
{
    public function index(){
        return view('dash.index');
    }
}
