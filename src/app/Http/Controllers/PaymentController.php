<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
// クレジット決済
    public function credit(Request $request){
        $amount=$request['amount'];
        return view('credit', compact('amount'));
    }

    public function payment(Request $request){
        $amount=$request['amount'];
        $request->user()->charge($amount, $request->paymentMethodId);
        return view('done');
    }
}
