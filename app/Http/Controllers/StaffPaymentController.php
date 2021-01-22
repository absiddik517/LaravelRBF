<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\StaffPayment;
use Illuminate\Support\Facades\Auth;
use Dates;

use App\Http\Requests\StaffPaymentValidation;

class StaffPaymentController extends Controller
{
    public function store(StaffPaymentValidation $request){
      StaffPayment::create([
          'staff_id'     => $request['staff_id'],
          'amount'       => $request['amount'],
          'date'         => Dates::Today(),
          'user_id'      => Auth::user()->id
      ]);
        
      $res = [
        'm' => __('msg.staff_pay_success'),  
        't' => __('msg.success'),
        's' => 'success',  
      ];
      return response()->json($res);
    }
}
