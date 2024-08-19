<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class QRController extends Controller
{
    public function qrcode(Request $request){
        $reservation_id=$request['reservation-id'];
        return view ('qrcode', compact('reservation_id'));
    }

    public function confirm(){
        return view ('qrcode_confirm');
    }

    public function visit(Request $request){
        $visit_status=Reservation::find($request['reservation-id'])['visit_status'];
        Reservation::find($request['reservation-id'])->update([
            "visit_status" => true,
        ]);
        return view('done', compact('visit_status'));
    }
}
