<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Review;
use App\Models\User;
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
            if($request->file('review_img') !== null){
                $path=Storage::disk('public')->putFile('review-img', $request->file('review_img'));
                $full_path = Storage::disk('public')->url($path);
            }else{
                $full_path=null;
            }
            Review::create([
                "user_id" => $user_id,
                "shop_id" => $shop_id,
                "score" => $request['score'],
                "comment" => $request['comment'],
                "review_img" => $full_path,
            ]);
            return redirect('/detail/'.$shop_id)->with('messages', '口コミを投稿しました');
        }
    }

    // 口コミ削除
    public function reviewDelete(Request $request){
        $review=Review::find($request['review_id']);
        $shop_id=$review->shop_id;
        $review->delete();

        $user=User::with('role')->find(Auth::id());
        if($user->role->score === 100){
            $shop=Shop::find($shop_id)->first();
            $reviews=Review::ShopSearch($shop_id)->with('user')->get();

            return view('review_list', compact('shop', 'reviews'));
        }else{
            return redirect('/detail/'.$shop_id)->with('messages', '口コミを削除しました');
        }
    }

    // 口コミ一覧
    public function reviewList(Request $request){
        $shop_id=$request['shop_id'];
        $shop=Shop::find($shop_id);
        $reviews=Review::ShopSearch($shop_id)->with('user')->get();

        return view('review_list', compact('shop', 'reviews'));
    }

    // 口コミ修正
    public function reviewEdit(Request $request){
        $user_id=Auth::id();
        $review=Review::with('shop')->find($request['review_id']);

        if($user_id === $review->user_id){
            return view('review_edit', compact('review'));
        }else{
            return redirect('/');
        }
    }

    public function reviewUpdate(ReviewRequest $request){
        $review=Review::find($request['review_id']);
        if($request->file('review_img') !== null){
                $path=Storage::disk('public')->putFile('review-img', $request->file('review_img'));
                $full_path = Storage::disk('public')->url($path);
        }else{
            $full_path=$review->review_img;
        }
        $review->update([
            "user_id" => $review->user_id,
            "shop_id" => $review->shop_id,
            "score" => $request['score'],
            "comment" => $request['comment'],
            "review_img" => $full_path,
        ]);

        return redirect('/detail/'.$review->shop_id)->with('messages', '口コミを修正しました');
    }
}
