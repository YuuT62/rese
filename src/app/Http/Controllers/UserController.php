<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
// マイページ表示
    public function mypage(){
        $user_id=Auth::id();
        $user_name=Auth::user()->name;
        $reservations=Reservation::with('shop')->UserSearch($user_id)->get
        ();
        $favorites=Favorite::with('shop')->UserSearch($user_id)->get();
        return view('mypage', compact('user_id', 'user_name','reservations','favorites'));
    }

// サンクスページ表示
    public function thanks(){
        return view ('thanks');
    }
}

