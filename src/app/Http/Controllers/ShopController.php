<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReservationInputRequest;

class ShopController extends Controller
{
// 店舗一覧表示
    public function index(){
        $shops=Shop::get();
        $user_id=Auth::id();
        $favorites=Favorite::UserSearch($user_id)->get();
        return view ('index', compact('shops', 'favorites'));
    }

    public function favorite(Request $request){
        $user_id = Auth::id();
        $shop_id = $request->shop_id;
        $already_favorite = Favorite::where('user_id', $user_id)->where('shop_id', $shop_id)->exists();

        if (!$already_favorite) {
            $favorite = new Favorite;
            $favorite->shop_id = $shop_id;
            $favorite->user_id = $user_id;
            $favorite->save();
        } else {
            Favorite::UserSearch($user_id)->ShopSearch($shop_id)->delete();
        }
    }

// 店舗詳細表示
    public function detail(ReservationInputRequest $request){
        $shop_id=$request['shop_id'];
        $shop=Shop::find($shop_id);
        $user_id=Auth::id();
        $review=Review::ShopSearch($shop_id)->UserSearch($user_id)->first();
        return view ('detail', compact('shop', 'review'));
    }

// 店舗検索処理
    public function search(Request $request){
        $area_id=$request['area_id'];
        $genre_id=$request['genre_id'];
        $keyword=$request['keyword'];
        $shops=Shop::AreaSearch($area_id)->GenreSearch($genre_id)->KeywordSearch($keyword)->get();
        $user_id=Auth::id();
        $favorites=Favorite::UserSearch($user_id)->get();
        return view ('index', compact('area_id','genre_id' ,'keyword' ,'shops', 'favorites'));
    }


// 店舗一覧ソート
    public function sort(Request $request){
        $user_id=Auth::id();
        $favorites=Favorite::UserSearch($user_id)->get();
        // ランダム
        if($request['sort']==="1"){
            $shops=Shop::inRandomOrder()->get();
            return view ('index', compact('shops', 'favorites'));
        // 評価高い順
        }else if($request['sort']==="2"){
            $shops=Shop::with('reviews')->get();
            $scores=[];
            foreach($shops as $shop){
                $score=0;
                if($shop->reviews->count()!==0){
                    foreach($shop->reviews as $review){
                        $score+=$review->score;
                    }
                    $score=$score/$shop->reviews->count();
                    $scores[$shop->id]=$score;
                }else{
                    $scores[$shop->id]=0;
                }
            }
            arsort($scores);
            $scores=array_keys($scores);
            $shops=Shop::whereIn('id', $scores)->orderByRaw('FIELD(id, '.implode(',', $scores).')')->get();
            return view ('index', compact('shops', 'favorites'));
        // 評価低い順
        }else{
            $shops=Shop::with('reviews')->get();
            $scores=[];
            foreach($shops as $shop){
                $score=0;
                if($shop->reviews->count()!==0){
                    foreach($shop->reviews as $review){
                        $score+=$review->score;
                    }
                    $score=$score/$shop->reviews->count();
                    $scores[$shop->id]=$score;
                }else{
                    $scores[$shop->id]=10;
                }
            }
            asort($scores);
            $scores=array_keys($scores);
            $shops=Shop::whereIn('id', $scores)->orderByRaw('FIELD(id, '.implode(',', $scores).')')->get();
            return view ('index', compact('shops', 'favorites'));
        }
    }
}
