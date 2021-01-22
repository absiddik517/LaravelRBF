<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Money;

class PagesController extends Controller
{	
	function __construct()
    {
        return $this->middleware('auth');
    }
    
    public function ipl(){
        return view('pages.ipl.prediction');
    }
    
    public function football(){
        return view('pages.ipl.football');
    }
    
    public function index()
    {
    	return view('pages.dashboard.dashboard');
    }

    /*public function ajaxPost(Request $request)
    {
    	$data = $request->all();

    	$valid = array(
            'name' => 'required', 
            'phone' => 'required',
            'address' => 'required'
        );

        $v = Validator::make($data, $valid);

    	if(!$v->passes()){
    		$messages = $v->messages();

    		foreach ($valid as $key => $value) {
    			$verrors[$key] = $messages->first($key);
    		}

    		$response = array(
    			'validation_failed' => 1,
    			'errors' => $verrors
     		);

    		$users = DB::table('users')
                ->insert();

    	}else{
    		$response = array(
    			'validation_failed' => 0,
    			'm' => 'Validation passed',
    			's' => 'success',
    			't' => 'Successfull'
    		);
    	}
     		return response()->json($response);

    }*/
    
    
}
