<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Favorite;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use DateTime;

class ReservationController extends Controller
{
    public function add(Request $request){
        $date=explode(' ',$request['date-result'])[0];
        $time=$request['time-result'];
        $reservation=new DateTime($date.' '.$time.':00');
        $num=$request['num-result'];
        $user_id=Auth::id();
        $shop_id=$request['shop-id'];
        Reservation::create([
                "user_id" => $user_id,
                "shop_id" => $shop_id,
                "reservation" => $reservation,
                "num_people" => $num,
            ]);
        return redirect('/done');
    }

    public function delete(Request $request){
        Reservation::find($request['reservation-id'])->delete();
        return redirect('/mypage');
    }

    public function done(){
        return view('done');
    }

    public function change(Request $request){
        $reservation_id=$request['reservation-id'];
        $reservation=Reservation::find($reservation_id);
        $shop_id=$reservation->shop_id;
        $shop=Shop::find($shop_id);

        return view('change', compact('shop', 'reservation'));
    }

    public function edit(Request $request){
        $reservation_id=$request['reservation-id'];
        $reservation=Reservation::find($reservation_id);
        $shop_id=$reservation->shop_id;
        $shop=Shop::find($shop_id);
        return view ('change', compact('shop', 'reservation'));
    }

    public function update(Request $request){
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
        return redirect('/done');
    }


    public function evaluation(Request $request){
        $reservation_id=$request['reservation-id'];
        $reservation=Reservation::find($reservation_id);
        $shop_id=$reservation->shop_id;
        $shop=Shop::find($shop_id);

        return view('evaluation', compact('shop', 'reservation'));
    }
}
