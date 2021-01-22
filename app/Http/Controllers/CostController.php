<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\Cost;
use Illuminate\Support\Facades\Auth;
use Dates;

use App\Http\Requests\NormalCostValidation;

class CostController extends Controller
{
    function __construct()
    {
        return $this->middleware('auth');
    }
    
    public function index() 
    {
      
    	return view('pages.cost.addCost');
    }

    public function showAll()
    {
    	return view('pages.cost.view-all');
    }

    public function showToday()
    {
    	return view('pages.cost.view-today');
    }


    public function create(NormalCostValidation $request)
    {
        Cost::create([
            'description'   => $request['description'],
            'amount'        => $request['amount'],
            'user_id'       => Auth::user()->id,
            'date'          => Dates::Today(),
        ]);
        
        $res = [
          'm' => __('msg.cost_success'),  
          't' => __('msg.success'),  
          's' => 'success',  
        ];
        return response()->json($res);
    }
}

