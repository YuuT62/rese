<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Illuminate\Support\Facades\Auth;


class PaymentController extends Controller
{
    public function subscription(){
        $intent=Auth()->user()->createSetupIntent();
        return view('subscription', compact('intent'));
    }

    public function subscriptionDo(Request $request){
        $request->user()->newSubscription(
        'default', 'price_1PoalFRrWkpTIcj7XS8aPHGW')->create($request->paymentMethodId);
        return view('completion');
    }

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
