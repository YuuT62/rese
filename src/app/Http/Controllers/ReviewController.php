<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Review;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ReviewRequest;


class ReviewController extends Controller
{
    // 口コミ投稿ページ
    public function review(Request $request){
        $user_id=Auth::id();
        $shop_id=$request['shop_id'];
        $shop=Shop::find($shop_id);
        $review=Review::ShopSearch($shop_id)->UserSearch($user_id)->first();
        if(isset($review)){
            return redirect('/detail/'.$shop_id)->with('messages','すでに口コミが投稿されています');
        }else{
            $favorite=Favorite::ShopSearch($shop->id)->UserSearch($user_id)->first();
            $favorites=Favorite::UserSearch($user_id)->get();
            return view('review', compact('shop', 'favorite'));
        }
    }

    // 口コミ投稿
    public function reviewSend(ReviewRequest $request){
        $user_id=Auth::id();
        $shop_id=$request['shop_id'];
        $review=Review::ShopSearch($shop_id)->UserSearch($user_id)->first();
        if(isset($review)){
            return redirect('/detail/'.$shop_id)->with('messages','すでに口コミが投稿されています');
        }else{
            $path=Storage::disk('public')->putFile('review-img', $request->file('review_img'));
            $full_path = Storage::disk('public')->url($path);
            Review::create([
                "user_id" => $user_id,
                "shop_id" => $shop_id,
                "score" => $request['score'],
                "comment" => $request['comment'],
                "review_img" => $full_path,
            ]);
            return redirect('/detail/'.$shop_id);
        }
    }

    public function reviewDelete(Request $request){
        $user_id=$request['user_id'];
        $shop_id=$request['shop_id'];
        Review::ShopSearch($shop_id)->UserSearch($user_id)->delete();

        return redirect('/detail/'.$shop_id);
    }
}
