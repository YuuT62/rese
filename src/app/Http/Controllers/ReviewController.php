<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Review;
use Illuminate\Support\Facades\Storage;


class ReviewController extends Controller
{
    // 口コミ機能
    public function review(Request $request){
        $user_id=Auth::id();
        $shop=Shop::find($request['shop_id']);
        $favorite=Favorite::ShopSearch($shop->id)->UserSearch($user_id)->first();
        $favorites=Favorite::UserSearch($user_id)->get();
        return view('review', compact('shop', 'favorite'));
    }

    public function reviewSend(Request $request){
        $user_id=Auth::id();
        $shop_id=$request['shop_id'];
        $path=Storage::disk('public')->putFile('review-img', $request->file('review_img'));
        $full_path = Storage::disk('public')->url($path);
        Review::create([
            "user_id" => $user_id,
            "shop_id" => $shop_id,
            "score" => $request['score'],
            "comment" => $request['comment'],
            "img" => $full_path,
        ]);
        return redirect('/detail/'.$shop_id);
    }
}
