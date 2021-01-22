<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Dealer;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\DealerValidation;

class DealerController extends Controller
{
    function __construct()
    {
        return $this->middleware('auth');
    }
    
    public function index()
    {
    	return view('pages.dealer.index');
    }

    public function accounts()
    {
    	return view('pages.dealer.account');
    }

    public function payments()
    {
    	return view('pages.dealer.payments');
    }
    
    public function Store(DealerValidation $request){
      Dealer::create([
          'name'         => $request['name'],
          'address'      => $request['address'],
          'title'        => $request['title'],
          'phone'        => $request['phone'],
          'user_id'      => Auth::user()->id,
      ]);
        
      $res = [
        'm' => __('msg.dealer_success'),  
        't' => __('msg.success'),  
        's' => 'success',  
      ];
      return response()->json($res);
    }
    
    public function DealerTable(){
      $table = '<table class="table table-bordered table-hover table-striped"><thead><tr><th>#</th><th>'.__('tbl.name').'</th><th>'.__('msg.title').'</th><th>'.__('tbl.address').'</th><th>'.__('tbl.phone').'</th></tr></tbody>';
        $count = Dealer::count();
        if($count > 0){
            $data = Dealer::get();
            $i = 1;
            foreach ($data as $key) {
                $table .= '<tr>';
                $table .= '<td>'.$i.'</td>';
                $table .= '<td>'.$key["name"].'</td>';
                $table .= '<td>'.$key["title"].'</td>';
                $table .= '<td>'.$key["address"].'</td>';
                $table .= '<td>'.$key["phone"].'</td>';
                $table .= '</tr>';
                $i++;
            }
            $table .= '</tbody></table>';
            
        }else{
            $table .= "<tr><td colspan='5' style='text-align:center;'>".__('tbl.not_found')."</td></tr></tbody></table>";
        }


        return response()->json($table);
    }
}
