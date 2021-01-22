<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PartyTypeValidation;
use App\Model\PartyType;
use Illuminate\Support\Facades\Auth;
use PartyHelper;

class PartyTypeController extends Controller
{
    public function index(){
      return view('pages.party.partytype');
    }
    
    public function Store(PartyTypeValidation $request){
      PartyType::create([
          'name'          => $request['name'],
          'billing_system'=> $request['billing_system'],
          'task'          => $request['task'],
          'allow_advance' => $request['allow_advance'],
          'allow_daily_advance' => $request['allow_daily_advance'],
          'allow_preload' => $request['allow_preload'],
      ]);
      
      $res = [
        'm' => __('msg.pt_success'),  
        't' => __('msg.success'),              
        's' => 'success',  
      ];
      return response()->json($res);
    }
    
    public function GetList(){
      $table = '<table class="table table-bordered table-hover table-striped"><thead><tr><th>#</th><th>'.__('tbl.name').'</th><th>'.__('tbl.billing_system').'</th><th>'.__('tbl.task').'</th><th>'.__('tbl.allow_advance').'</th><th>'.__('tbl.allow_daily_advance').'</th><th>'.__('tbl.allow_preload').'</th></tr></tbody>';
        $count = PartyType::count();
        if($count > 0){
            $data = PartyType::get();
            $i = 1;
            foreach ($data as $key) {
                $table .= '<tr>';
                $table .= '<td>'.$i.'</td>';
                $table .= '<td>'.$key["name"].'</td>';
                $table .= '<td>'.$key["billing_system"].'</td>';
                $table .= '<td>'.$key["task"].'</td>';
                $table .= '<td>'.PartyHelper::YesNo($key["allow_advance"]).'</td>';
                $table .= '<td>'.PartyHelper::YesNo($key["allow_daily_advance"]).'</td>';
                $table .= '<td>'.PartyHelper::YesNo($key["allow_preload"]).'</td>';
                $table .= '</tr>';
                $i++;
            }
            $table .= '</tbody></table>';
            
        }else{
            $table .= "<tr><td colspan='7' style='text-align:center;'>".__('tbl.not_found')."</td></tr></tbody></table>";
        }


        return response()->json($table);
    }
    
    public function GetPartyData(Request $request){
      $id = $request->id;
      $data = PartyType::where('id', '=', $id)->first();
      
      return response()->json($data);
    }
    
}
