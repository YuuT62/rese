<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index(){
        $shops=Shop::get();
        $user_id=Auth::id();
        $favorites=Favorite::UserSearch($user_id)->get();
        return view ('index', compact('shops', 'favorites'));
    }

    public function favorite(Request $request){
        $user_id=Auth::id();
        $shop_id=$request['shop_id'];
        $favorite=Favorite::UserSearch($user_id)->ShopSearch($shop_id)->first();
        if(empty($favorite)){
            Favorite::create([
                "user_id" => $user_id,
                "shop_id" => $shop_id,
                "status" => true
            ]);
        }
        elseif($favorite->status){
            $favorite->update([
                "user_id" => $user_id,
                "shop_id" => $shop_id,
                "status" => false
            ]);
        }else{
            $favorite->update([
                "user_id" => $user_id,
                "shop_id" => $shop_id,
                "status" => true
            ]);
        }
        return redirect('/');

    }

    public function detail(Request $request){
        $shop_id=$request['shop_id'];
        $shop=Shop::ShopSearch($shop_id)->first();
        return view ('detail', compact('shop'));
    }

    public function search(Request $request){
        $area_id=$request['area_id'];
        $genre_id=$request['genre_id'];
        $keyword=$request['keyword'];
        $shops=Shop::AreaSearch($area_id)->GenreSearch($genre_id)->KeywordSearch($keyword)->get();
        $user_id=Auth::id();
        $favorites=Favorite::UserSearch($user_id)->get();
        return view ('index', compact('area_id','genre_id' ,'keyword' ,'shops', 'favorites'));
    }
}
