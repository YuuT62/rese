<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class QRController extends Controller
{
// QR読み取り
    public function qrcode(Request $request){
        $reservation_id=$request['reservation_id'];
        return view ('qrcode', compact('reservation_id'));
    }

    public function confirm(){
        return view ('qrcode_confirm');
    }

// 来店処理
    public function visit(Request $request){
        $visit_status=Reservation::find($request['reservation_id'])['visit_status'];
        Reservation::find($request['reservation_id'])->update([
            "visit_status" => true,
        ]);
        return view('done', compact('visit_status'));
    }
}
