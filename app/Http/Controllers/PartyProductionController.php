<?php

namespace App\Http\Controllers;

use App\Model\PartyProduction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Dates;
use App\Http\Requests\PartyProductionValidation;

class PartyProductionController extends Controller
{
    public function Store(PartyProductionValidation $request){
        PartyProduction::create([
          'party_id'    => $request['party_id'],
          'description' => $request['description'],
          'quantity'    => $request['quantity'],
          'user_id'     => Auth::user()->id,
          'date'        => Dates::Today(),
      ]);
      
        $res = array(
            's' => 'success',  
            't' => __('msg.success'),
            'm' => __('msg.party_production_success')
        );
        return response()->json($res);
    }
}
