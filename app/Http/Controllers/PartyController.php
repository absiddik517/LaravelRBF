<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PartyValidation;
use Illuminate\Support\Facades\Auth;
use App\Model\Party;
use App\Model\PartyType;
use App\Model\PartyProduction;
use App\Model\PartyBillPayment;
use Dates;
use PartyHelper;

class PartyController extends Controller
{
    function __construct()
    {
        return $this->middleware('auth');
    }
    
    public function index()
    {
    	return view('pages.party.index');
    }

    public function accounts($id)
    {
    	return view('pages.party.account', ['id' => $id]);
    }

    public function production()
    {
    	return view('pages.party.production');
    }

    public function payment()
    {
    	return view('pages.party.payment');
    }
    
    public function Store(PartyValidation $request){
      Party::create([
          'party_type'  => $request['party_type'],
          'name'        => $request['name'],
          'address'     => $request['address'],
          'phone'       => $request['phone'],
          'deal'        => $request['deal'],
          'rate'        => $request['rate'],
          'advance'     => $request['advance'],
          'cutting_rate'=> $request['cutting_rate'],
          'billing_day' => $request['billing_day'],
          'user_id'     => Auth::user()->id,
          'date'        => Dates::Today(),
      ]);
      
      $res = [
        'm' => __('msg.party_success'),  
        't' => __('msg.success'),          
        's' => 'success',  
      ];
      return response()->json($res);
    }
    
    public function PartyList(){
        $table = '<table class="table table-bordered table-hover table-striped"><thead><tr>';
        $table .= '<th>#</th>';
        $table .= '<th>'.__('tbl.type').'</th>';
        $table .= '<th>'.__('tbl.name').'</th>';
        $table .= '<th>'.__('tbl.address').'</th>';
        $table .= '<th>'.__('tbl.phone').'</th>';
        $table .= '<th>'.__('tbl.deal').'</th>';
        $table .= '<th>'.__('tbl.rate').'</th>';
        $table .= '<th>'.__('tbl.advance').'</th>';
        $table .= '<th>'.__('tbl.cutting_rate') .'</th>';
        $table .= '<th>'.__('tbl.billing_day').'</th>';
        $table .= '<th>'.__('tbl.date').'</th>';
        $table .= '<th>'.__('tbl.action').'</th>';
        $table .= '</tr></tbody>';
        $count = Party::count();
        if($count > 0){
            $data = Party::with('PartyDetail')->get();
            $i = 1;
            foreach ($data as $key) {
                $table .= '<tr>';
                $table .= '<td>'.$i.'</td>';
                $table .= '<td>'.$key->PartyDetail["name"].'</td>';
                $table .= '<td>'.$key["name"].'</td>';
                $table .= '<td>'.$key["address"].'</td>';
                $table .= '<td>'.$key["phone"].'</td>';
                $table .= '<td>'.$key["deal"].'</td>';
                $table .= '<td>'.$key["rate"].'</td>';
                $table .= '<td>'.$key["advance"].'</td>';
                $table .= '<td>'.$key["cutting_rate"].'</td>';
                $table .= '<td>'.$key["billing_day"].'</td>';
                $table .= '<td>'.$key["date"].'</td>';
                $table .= '<td><a href="'. route('party.account', $key['id']) .'">Account</a></td>';
                $table .= '</tr>';
                $i++;
            }
            $table .= '</tbody></table>';
            
        }else{
            $table .= "<tr><td colspan='11' style='text-align:center;'>".__('tbl.not_found')."</td></tr></tbody></table>";
        }


        return response()->json($table);
    }
    
    public function PartyListSelect(Request $request){
        $party_type = $request->party_type;
        $table = '<option value="">'.__('tbl.s_one').'</option>';
        $count = Party::where('party_type', '=', $party_type)->count();
        if($count > 0){
            $data = Party::where('party_type', '=', $party_type)->get();
            foreach ($data as $key) {
                $table .= '<option value="'.$key["id"].'">'.$key["name"].'</option>';
            }
            
        }else{
            $table .= "<option disabled value=''>".__('tbl.sardar_not_found')."</option>";
        }
        
        //partytype configarations 
        
        $res = [];
        $result = PartyType::where('id', '=', $party_type)->first();
        $res['allow_daily_advance'] = $result['allow_daily_advance'];
        $res['billing_system'] = $result['billing_system'];
        
        $response = array(
            'option' => $table,
            'config' => $res
        );
        return response()->json($response);
    }
    
    public function PartyDetails(Request $request){
        $id = $request['id'];
        $party = Party::where('id', $id)->with(['PartyDetail'])->first();
        $production = PartyProduction::where('party_id', $id)->sum('quantity');
        $paid = PartyHelper::TotalPaid($id);
        $damage_rate = $party->PartyDetail->damage_rate;
        $output = array(
            'name' => $party->name,
            'address' => $party->address,
            'phone' => $party->phone,
            'rate' => $party->rate,
            'advance' => $party->advance,
            'cutting_rate' => $party->cutting_rate,
            'billing_day' => $party->billing_day,
            'production' => $production,
            'cutted' => round(PartyHelper::_p($production, $damage_rate, 'm')),
            'selery' => round(PartyHelper::_p($production, $damage_rate, 'm') * $party->rate),
            'paid' => $paid,
            'balance' => round(PartyHelper::_p($production, $damage_rate, 'm') * $party->rate) - $paid,
            
            'allow_daily_advance' => $party->PartyDetail->allow_daily_advance,
            'allow_advance' => $party->PartyDetail->allow_advance,
            'allow_preload' => $party->PartyDetail->allow_preload,
            'allow_damage' => $party->PartyDetail->allow_damage,
            
        );
        
        return response()->json($output);
    }
    
    public function PartyDetailsAfterBill(Request $request){
        $id = $request->id;
        $last_date = PartyHelper::LastBill($id, 'last_date');
        $production = PartyProduction::where('party_id', $id)->whereBetween('date', [Dates::Next($last_date), Dates::Today()])->sum('quantity');
        
        $output = array(
            'production' => $production,
            'selery' => PartyHelper::Selery($id, $production),
            'paid' => PartyHelper::PaidAfterBill($id),
            'balance' => PartyHelper::Selery($id, $production) + PartyHelper::PreloadAmount($id, $last_date) - PartyHelper::PaidAfterBill($id),
            'title_start' => Dates::SR(Dates::Next($last_date)),
            'title_end' => date('d-m-Y'),
        );
        return response()->json($output);
    }
    
    
    
}
