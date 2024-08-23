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
        $favorites=Favorite::with('shop')->UserSearch($user_id)->StatusSearch(true)->get();
        return view('mypage', compact('user_id', 'user_name','reservations','favorites'));
    }

// マイページお気に入り処理
    public function favoriteTrue(Request $request){
        if(empty(session()->get('key_true'))){
            session()->flash('key_true', 'key_reload');
            $user_id=Auth::id();
            $user_name=Auth::user()->name;
            $shop_id=$request['shop_id'];
            $favorite_id=$request['favorite_id'];
            $favorites=Favorite::with('shop')->UserSearch($user_id)->StatusSearch(true)->get();
            $reservations=Reservation::with('shop')->UserSearch($user_id)->get
            ();
            $favorite=Favorite::find($favorite_id);
            $favorite->update([
                "user_id" => $user_id,
                "shop_id" => $shop_id,
                "status" => false
            ]);
            foreach($favorites as &$fav){
                if($fav['shop_id']==$shop_id){
                    $fav['status']=false;
                }
            }

            return view('mypage', compact('user_id', 'user_name','reservations','favorites'));

        }else{
            return redirect('/mypage');
        }
    }

    public function favoriteFalse(Request $request){
        if(empty(session()->get('key_false'))){
            session()->flash('key_false', 'key_reload');
            $user_id=Auth::id();
            $user_name=Auth::user()->name;
            $shop_id=$request['shop_id'];
            $favorite_id=$request['favorite_id'];
            $favorites=Favorite::with('shop')->UserSearch($user_id)->StatusSearch(true)->get();
            $reservations=Reservation::with('shop')->UserSearch($user_id)->get
            ();
            $favorite=Favorite::find($favorite_id);
            $favorite->update([
                "user_id" => $user_id,
                "shop_id" => $shop_id,
                "status" => true
            ]);
            $favorites=Favorite::with('shop')->UserSearch($user_id)->StatusSearch(true)->get();

            return view('mypage', compact('user_id', 'user_name','reservations','favorites'));

        }else{
            return redirect('/mypage');
        }
    }

// サンクスページ表示
    public function thanks(){
        return view ('thanks');
    }
}

