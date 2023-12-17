<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Region;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //

    public function index (){


        $title = 'Home';
        return view('welcome', compact('title'));
    }
    public function login (){

        $title = 'Login';
        return view('login', compact('title'));
    }
    public function register (){

        $title = 'Register';
        return view('register', compact('title'));
    }
    public function order (){

        $regions =Region::all();
        $cities = City::all();
        $title = 'Order';
        return view('order', compact('title','regions', 'cities'));
    }
}
