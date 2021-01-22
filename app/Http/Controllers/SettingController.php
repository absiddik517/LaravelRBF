<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Users;
use Illuminate\Support\Facades\Auth;
use Dates;

class SettingController extends Controller
{
    public function index(){
        return view('pages.settings.index');
    }
    
    public function UpdateDate(Request $request){
        $id = Auth::user()->id;
        $user = Users::find($id);
        if($request->all()['query'] == 'set'){
            $user->system_date = Dates::DB($request->all()['date']);
        }else{
            $user->system_date = null;
        }
        $user->save();
        
        $res = [
          'm' => __('msg.update_success'),  
          't' => __('msg.success'),  
          's' => 'success',  
        ];
        return response()->json($res);
    }
}
