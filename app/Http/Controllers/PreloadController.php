<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Preload;
use App\Http\Requests\PreloadValidation;
use Illuminate\Support\Facades\Auth;
use Dates;

class PreloadController extends Controller
{
    public function Store(PreloadValidation $request){
        Preload::create([
            'party_id'      => $request['party_id'],
            'item_id'       => $request['item_id'],
            'quantity'      => $request['quantity'],
            'description'      => $request['description'],
            'amount'        => $request['amount'],
            'user_id'       => Auth::user()->id,
            'date'          => Dates::Today(),
        ]);
        
        $res = array(
            'm' => 'Item added successfull',
            't' => __('msg.success'),
            's' => 'success'
        );
        
        return response()->json($res);
    }
}
