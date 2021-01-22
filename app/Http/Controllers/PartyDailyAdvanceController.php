<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PartyDailyAdvanceValidation;
use App\Model\PartyDailyAdvance;
use Illuminate\Support\Facades\Auth;
use Dates;

class PartyDailyAdvanceController extends Controller
{
    public function Store(PartyDailyAdvanceValidation $request){
        
        PartyDailyAdvance::create([
            'party_id'      => $request['party_id'],
            'description'   => $request['description'],
            'amount'        => $request['amount'],
            'user_id'       => Auth::user()->id,
            'date'          => Dates::Today(),
        ]);
        
        $res = array(
            'm' => __('msg.pad_success'),
            't' => __('msg.success'),
            's' => 'success'
        );
        
        return response()->json($res);
    }
}
