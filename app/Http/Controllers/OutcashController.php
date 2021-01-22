<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Outcash;
use Illuminate\Support\Facades\Auth;
use Dates;

use App\Http\Requests\OutcashValidation;

class OutcashController extends Controller
{
	function __construct()
    {
        return $this->middleware('auth');
    }
    
    public function index()
    {
    	return view('pages.outcash.take-loan');
    }

    public function showAll()
    {
    	return view('pages.outcash.all-loan');
    }
    
    public function Store(OutcashValidation $request){
        Outcash::create([
            'name'           => $request['name'],
            'address'        => $request['address'],
            'phone'          => $request['phone'],
            'description'    => $request['description'],
            'amount'         => $request['amount'],
            'is_owner'       => $request['is_owner'],
            'user_id'        => Auth::user()->id,
            'date'           => Dates::Today(),
        ]);
        
        $res = [
          'm' => __('msg.outcash_success'),  
          't' => __('msg.success'),  
          's' => 'success',  
        ];
        return response()->json($res);
    }
}
