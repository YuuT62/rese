<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function admin(){
        return view ('admin');
    }

    public function mail(){
        return view ('mail.WelcomeEmail');
    }

    public function qrcode(Request $request){
        $reservation_id=$request['reservation-id'];
        return view ('qrcode', compact('reservation_id'));
    }

    public function confirm(){
        return view ('qrcode_confirm');
    }

    public function credit(){
        return view ('credit');
    }


}
