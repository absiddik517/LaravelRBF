<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PartyBillValidation;
use App\Model\PartyBill;
use Illuminate\Support\Facades\Auth;
use Dates;


class PartyBillController extends Controller
{
    public function Store(PartyBillValidation $request){
        PartyBill::create([
            'party_id'      => $request['party_id'],
            'description'   => $request['description'],
            'amount'        => $request['amount'],
            'user_id'       => Auth::user()->id,
            'date'          => Dates::Today(),
        ]);
        
        
        $res = array(
            'm' => __('msg.party_bill_success'),
            't' => __('msg.success'),
            's' => 'success'
        );
        
        return response()->json($res);
    }
}
