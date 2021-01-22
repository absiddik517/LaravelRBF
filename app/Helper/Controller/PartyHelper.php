<?php
namespace App\Helper\Controller;


use App\Model\Party;
use App\Model\PartyType;
use App\Model\PartyProduction;

use App\Model\PartyBill;
use App\Model\PartyBillPayment;
use App\Model\PartyDailyAdvance;
use App\Model\AdvanceCutting;
use App\Model\Preload;
use App\Model\Item;

//helpers
use Money;
use Dates;

/**
 * 
 */
class PartyHelper
{
    
    public function AllowAdvance($party_id){
        $data = Party::where('id', $this->id)->with('PartyDetail')->first();
        
    }
    
    public function YesNo($arg){
        return ($arg == 'true') ? 'Yes' : 'No';
    }
    
    public function _p(int $num, int $p, $action=''){
        $value = $num * ($p/100);
        if($action == ''){
            return $value;
        }else if($action == 'a'){
            return $num + $value;
        }else if($action == 'm'){
            return $num - $value;
        }
    }
    
    public function LastBill($party_id, $query){
        $count = PartyBill::where('party_id', $party_id)->orderBy('id', 'desc')->count();
        if($count > 0){
            $bill = PartyBill::where('party_id', $party_id)->orderBy('id', 'desc')->first();
            return $bill[$query];
        }else{
            return null;
        }
    }
    
    public function Selery($party_id, $production){
        $party = Party::where('id', $party_id)->with(['PartyDetail'])->first();
        if($party->PartyDetail->allow_damage == 'true'){
            $product = $this->_p($production, $party->PartyDetail->damage_rate, 'm');
        }else{
            $product = $production;
        }
        
        return round($product * $party->rate);
    }
    
    public function PreloadAmount($party_id, $last){
        //$last = $this->LastBill('last_date');
        $data = Preload::where('id', $party_id)->
                whereBetween('date', [Dates::Next($last), Dates::Today()])->
                with('Items')->
                get();
        $toAdd = 0;
        $toCut = 0;
        foreach ($data as $key){
            if($key->Items['action'] == 'Add to bill'){
                $toAdd += $key['amount'];
            }else if($key->Items['action'] == 'Add to paid'){
                $toCut += $key['amount'];
            } 
        }
        
        return $toAdd - $toCut;
    }
    
    public function TotalPaid($party_id){
        $paid = PartyBillPayment::where([['party_id', $party_id]])->sum('amount') +
                PartyDailyAdvance::where([['party_id', $party_id]])->sum('amount') + 
                AdvanceCutting::where([['party_id', $party_id]])->sum('amount');
        
        return $paid;
    }
    
    public function PaidAfterBill($party_id){
        $last = $this->LastBill($party_id, 'last_date');
        $paid = PartyBillPayment::where('party_id', $party_id)->whereBetween('date', [Dates::Next($last), Dates::Today()])->sum('amount') +
                PartyDailyAdvance::where('party_id', $party_id)->whereBetween('date', [Dates::Next($last), Dates::Today()])->sum('amount') + 
                AdvanceCutting::where('party_id', $party_id)->whereBetween('date', [Dates::Next($last), Dates::Today()])->sum('amount');
        
        return $paid;
    }
    
    public function Party($id){
        $data = Party::where('id', $id)->with(['PartyDetail'])->first();
        return $data;
    }
    
}