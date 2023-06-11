<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\shoppingCart;


class MainController extends Controller
{
    public function index(){

        return view('home.index');
    }
}
