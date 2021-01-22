<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\SubmitCash;
use App\Http\Requests\SubmitCashValidation;
use Illuminate\Support\Facades\Auth;
use Dates;

class SubmitCashController extends Controller
{
    public function store(SubmitCashValidation $request){
      SubmitCash::create([
            'owner_id'      => $request['owner_id'],
            'description'   => $request['description'],
            'amount'        => $request['amount'],
            'user_id'       => Auth::user()->id,
            'date'          => Dates::Today(),
        ]);
        
        $res = [
          'm' => __('msg.submit_cash_success'),  
          't' => __('msg.success'),
          's' => 'success',  
        ];
        return response()->json($res);
    }
}
