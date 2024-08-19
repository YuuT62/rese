<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Favorite;
use App\Models\Shop;
use App\Models\Evaluation;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReservationInputRequest;
use App\Http\Requests\ReservationResultRequest;
use DateTime;


class ReservationController extends Controller
{
    public function add(ReservationResultRequest $request){
        $reservation=new DateTime($request['reservation']);
        $num=$request['num-result'];
        $user_id=Auth::id();
        $shop_id=$request['shop-id'];
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

    public function delete(Request $request){
        Reservation::find($request['reservation-id'])->delete();
        return redirect('/mypage');
    }

    public function done(){
        return view('done');
    }


    public function edit(ReservationInputRequest $request){
        $reservation_id=$request['reservation-id'];
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
        $date=explode(' ',$request['date-result'])[0];
        $time=$request['time-result'];
        $reservation=new DateTime($date.' '.$time.':00');
        $num=$request['num-result'];
        $user_id=Auth::id();
        $reservation_id=$request['reservation-id'];
        $shop_id=$request['shop-id'];
        Reservation::find($reservation_id)->update([
                "user_id" => $user_id,
                "shop_id" => $shop_id,
                "reservation" => $reservation,
                "num_people" => $num,
            ]);
        return view('done');
    }


    public function evaluation(Request $request){
        $reservation_id=$request['reservation-id'];
        $reservation=Reservation::find($reservation_id);
        $shop_id=$reservation->shop_id;
        $shop=Shop::find($shop_id);

        return view('evaluation', compact('shop', 'reservation'));
    }

    public function evaluationAdd(Request $request){
        Evaluation::create([
            'user_id' => Auth::id(),
            'shop_id' => $request['shop-id'],
            'evaluation_general' => $request['grade-result-general'],
            'evaluation_meal' => $request['grade-result-meal'],
            'evaluation_service' => $request['grade-result-service'],
            'evaluation_atmosphere' => $request['grade-result-atmosphere'],
            'comment' => $request['comment-result'],
        ]);
        Reservation::find($request['reservation-id'])->update([
                "evaluation_status" => true,
            ]);

        return view('done');
    }
}
