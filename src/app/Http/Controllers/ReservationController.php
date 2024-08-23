<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\Evaluation;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReservationInputRequest;
use App\Http\Requests\ReservationResultRequest;
use DateTime;

class ReservationController extends Controller
{
// 新規予約
    public function add(ReservationResultRequest $request){
        $reservation=new DateTime($request['reservation']);
        $num=$request['num_result'];
        $user_id=Auth::id();
        $shop_id=$request['shop_id'];
        Reservation::create([
                "user_id" => $user_id,
                "shop_id" => $shop_id,
                "reservation" => $reservation,
                "num_people" => $num,
                "visit_status" => false,
                "evaluation_status" => false,
            ]);
        return view('done');
    }

// 予約削除
    public function delete(Request $request){
        Reservation::find($request['reservation_id'])->delete();
        return redirect('/mypage');
    }

// 予約完了ページ表示
    public function done(){
        return view('done');
    }

// 予約内容修正
    public function edit(ReservationInputRequest $request){
        $reservation_id=$request['reservation_id'];
        $reservation=Reservation::find($reservation_id);
        $shop_id=$reservation->shop_id;
        $shop=Shop::find($shop_id);
        if($reservation->user_id == Auth::id()){
            return view ('edit', compact('shop', 'reservation'));
        }else{
            return redirect('/');
        }
    }

    public function update(ReservationResultRequest $request){
        $date=explode(' ',$request['date_result'])[0];
        $time=$request['time_result'];
        $reservation=new DateTime($date.' '.$time.':00');
        $num=$request['num_result'];
        $user_id=Auth::id();
        $reservation_id=$request['reservation_id'];
        $shop_id=$request['shop_id'];
        Reservation::find($reservation_id)->update([
                "user_id" => $user_id,
                "shop_id" => $shop_id,
                "reservation" => $reservation,
                "num_people" => $num,
            ]);
        return view('done');
    }

// 評価
    public function evaluation(Request $request){
        $reservation_id=$request['reservation_id'];
        $reservation=Reservation::find($reservation_id);
        $shop_id=$reservation->shop_id;
        $shop=Shop::find($shop_id);

        return view('evaluation', compact('shop', 'reservation'));
    }

    public function evaluationAdd(Request $request){
        Evaluation::create([
            'user_id' => Auth::id(),
            'shop_id' => $request['shop_id'],
            'evaluation_general' => $request['grade_result_general'],
            'evaluation_meal' => $request['grade_result_meal'],
            'evaluation_service' => $request['grade_result_service'],
            'evaluation_atmosphere' => $request['grade_result_atmosphere'],
            'comment' => $request['comment_result'],
        ]);
        Reservation::find($request['reservation_id'])->update([
                "evaluation_status" => true,
            ]);

        return view('done');
    }
}
