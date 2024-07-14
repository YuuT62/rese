<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DevController extends Controller
{

    public function login(){
        return view ('login');
    }

    public function register(){
        return view ('register');
    }

    public function thanks(){
        return view ('thanks');
    }

    public function done(){
        return view ('done');
    }

    public function detail(){
        return view ('detail');
    }

    public function evaluation(){
        return view ('evaluation');
    }


}
