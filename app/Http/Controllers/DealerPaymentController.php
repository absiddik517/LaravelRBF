<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\DealerPayment;
use Illuminate\Support\Facades\Auth;
use Dates;

use App\Http\Requests\DealerPaymentValidation;


class DealerPaymentController extends Controller
{
    public function Store(DealerPaymentValidation $request){
      DealerPayment::create([
          'dealer_id'     => $request['dealer_id'],
          'provider'     => $request['provider'],
          'amount'       => $request['amount'],
          'date'         => Dates::Today(),
          'user_id'      => Auth::user()->id
      ]);
        
      $res = [
        'm' => __('msg.dealer_pay_success'),  
        't' => __('msg.success'),              
        's' => 'success',  
      ];
      return response()->json($res);
    }
}
