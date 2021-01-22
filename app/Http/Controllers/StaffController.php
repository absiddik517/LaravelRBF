<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Staff;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\StaffValidation;

class StaffController extends Controller
{
	function __construct()
    {
        return $this->middleware('auth');
    }
    
    public function index()
    {
    	return view('pages.staff.index');
    }

    public function accounts()
    {
    	return view('pages.staff.account');
    }

    public function payments()
    {
    	return view('pages.staff.payments');
    }
    
    public function store(StaffValidation $request){
      Staff::create([
          'name'         => $request['name'],
          'address'      => $request['address'],
          'phone'        => $request['phone'],
          'designation'  => $request['designation'],
          'selery'       => $request['selery'],
          'user_id'      => Auth::user()->id,
      ]);
        
      $res = [
        'm' => __('msg.staff_success'),  
        't' => __('msg.success'),  
        's' => 'success',  
      ];
      return response()->json($res);
    }
    
    public function DisplayTable(){
      $table = '<table class="table table-bordered table-hover table-striped"><thead><tr><th>#</th><th>'.__('tbl.name').'</th><th>'.__('tbl.address').'</th><th>'. __('tbl.phone') .'</th><th>'. __('tbl.designation') .'</th><th>'. __('tbl.selery') .'</th></tr></tbody>';
        $count = Staff::count();
        if($count > 0){
            $data = Staff::get();
            $i = 1;
            $total = 0;
            foreach ($data as $key) {
                $table .= '<tr>';
                $table .= '<td>'.$i.'</td>';
                $table .= '<td>'.$key["name"].'</td>';
                $table .= '<td>'.$key["address"].'</td>';
                $table .= '<td>'.$key["phone"].'</td>';
                $table .= '<td>'.$key["designation"].'</td>';
                $table .= '<td>'.$key["selery"].'</td>';
                $table .= '</tr>';
                $i++;
                $total += (int)$key['quantity'];
            }
            $table .= '</tbody></table>';
            
        }else{
            $table .= "<tr><td colspan='6' style='text-align:center;'>". __('tbl.not_found') ."</td></tr></tbody></table>";
        }


        return response()->json($table);
    }
}
