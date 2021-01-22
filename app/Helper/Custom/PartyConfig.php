<?php
namespace App\Helper\Custom;

use App\Model\Party;
use App\Model\PartyType;
use App\Model\PartyProduction;

use App\Model\PartyBill;
use App\Model\PartyDailyAdvance;
use App\Model\AdvanceCutting;
use App\Model\Preload;
use App\Helper\Money;
use App\Helper\Dates;
/**
 * App\Helper\Custom\PartyConfig
 */
class PartyConfig
{
    
    /**
     * @arg id
     */
    private $id;
    
    // party configaration
    public $type_id;
    public $billing_day;
    public $name;
    public $address;
    public $phone;
    public $rate;
    public $cutting_rate;
    public $damage_rate = 5;
    
    
    // party type configaration
    public $type;
    public $billing_system;
    public $allow_advance;
    public $allow_daily_advance;
    public $allow_preload;
    public $allow_damage_cutting;
    
    // party calculation
    
    public $production;
    public $production_filter;
    
    public $selery;
    public $selery_filter;
    
    public $paid;
    public $paid_filter;
    
    public $balance;
    public $balance_filter;
    
    public $start;
    public $end;
    
    public function __construct($id){
        $this->id = $id;
        $this->setVariables();
        $this->damage(); //will delete in future
        $this->setBalance();
        $this->setLength();
        $this->setBalanceFilter();
    }
    
    private function damage(){
        if($this->type == 'Mail Party'){
            $this->allow_damage_cutting = true;
        }else{
            $this->allow_damage_cutting = false;
        }
    }
    
    private function setVariables(){
        $data = Party::where('id', $this->id)->with('PartyDetail')->first();
        
        // party configaration
        $this->type_id = $data['party_type'];
        $this->billing_day = $data['billing_day'];
        $this->name = $data['name'];
        $this->address = $data['address'];
        $this->phone = $data['phone'];
        $this->rate = $data['rate'];
        $this->cutting_rate = $data['cutting_rate'];
        
        
        // party type configaration
        $this->type = $data->PartyDetail['name'];
        $this->billing_system = $data->PartyDetail['billing_system'];
        $this->allow_advance = $data->PartyDetail['allow_advance'];
        $this->allow_daily_advance = $data->PartyDetail['allow_daily_advance'];
        $this->allow_preload = $data->PartyDetail['allow_preload'];
        
        
        return true;
    }
    
    private function setBalance(){
        $id = $this->id;
        $production = $this->production = PartyProduction::where('party_id', $id)->sum('quantity');
        if($this->allow_damage_cutting === true){
            $selery = $this->selery = round(Money::_p($production, $this->damage_rate, 'm') * $this->rate);
        }else{
            $selery = $this->selery = round($production * $this->rate);
        }
        
        //party payments
        $daily_advance = PartyDailyAdvance::where('party_id', $id)->sum('amount');
        $bill = PartyBill::where('party_id', $id)->sum('amount');
        $advance_cutting = AdvanceCutting::where('party_id', $id)->sum('amount');
        $preload = Preload::where('party_id', $id)->sum('amount');
        
        $paid = $this->paid = $daily_advance + $bill + $advance_cutting + $preload;
        $this->balance = $selery - $paid;
        
        return true;
    }
    
    private function setBalanceFilter(){
        $id = $this->id;
        $production = $this->production_filter = PartyProduction::where('party_id', $id)->whereBetween('date', [$this->start, $this->end])->sum('quantity');
        if($this->allow_damage_cutting === true){
            $selery = $this->selery_filter = round(Money::_p($production, $this->damage_rate, 'm') * $this->rate);
        }else{
            $selery = $this->selery_filter = round($production * $this->rate);
        }
        
        //party payments
        $daily_advance = PartyDailyAdvance::where('party_id', $id)->whereBetween('date', [$this->start, $this->end])->sum('amount');
        $bill = 209; // PartyBill::where('party_id', $id)->whereBetween('date', [$this->start, $this->end])->sum('total');
        $advance_cutting = AdvanceCutting::where('party_id', $id)->whereBetween('date', [$this->start, $this->end])->sum('amount');
        $preload = Preload::where('party_id', $id)->whereBetween('date', [$this->start, $this->end])->sum('amount');
        
        $paid = $this->paid_filter = $daily_advance + $bill + $advance_cutting + $preload;
        $this->balance_filter = $selery - $paid;
        
        return true;
    }
    
    private function setLength(){
        if($this->billing_system == 'Weekly') $this->setWeek();
        if($this->billing_system == 'Monthly') $this->setMonth();
        if($this->billing_system == 'Daily') {
            $this->start = Dates::Today();
            $this->end = Dates::Today();
        }
        
        
        return true;
    }
    
    private function setWeek(){
        $this->start = $this->WeekFinder($this->billing_day, 'start');
        $this->end = $this->WeekFinder($this->billing_day, 'end');
        return true;
    }
    
    private function setMonth(){
       $this->start = $this->MonthFinder($this->billing_day, 'start'); 
       $this->end = $this->MonthFinder($this->billing_day, 'end'); 
       return true;
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
    
    public function WeekFinder($day, $request = '', $date = '', $format = 'Y-m-d')	{	
		
		if($date == ''){
			$time = strtotime(Dates::Today());
		}else{
			$time = strtotime($date);
		}

		switch ($day) {
			case 'Friday': $start = 'Saturday'; break;
			case 'Thursday': $start = 'Friday'; break;
			case 'Wednesday': $start = 'Thursday'; break;
			case 'Tuesday': $start = 'Wednesday'; break;
			case 'Monday': $start = 'Tuesday'; break;
			case 'Sunday': $start = 'Monday'; break;
			case 'Saturday': $start = 'Sunday'; break;
		}

		$week = date('w', $time);
		$bar = date('l', $time);
		if($bar == $day){
			$end = date($format, $time);
		}else{
			$end = date($format, strtotime("Next $day", $time));
		}
		if($bar == $start){
			$first = date($format, $time);
		}else{
			$first = date($format, strtotime("Last $start", $time));
		}


		if($request == 'start'){
			return $first;
		}else if($request == 'end'){
			return $end;
		}else{
			return $first.' / '.$end;
		}
	}
	
	private function MonthFinder($day, $request='', $date='', $format='Y-m-d'){
	    if($date == ''){
			$time = strtotime(Dates::Today());
		}else{
			$time = strtotime($date);
		}
		
		$start = date('Y-m-01', $time);
		$end = date('Y-m-t', $time);
		if($request == 'start'){
		    return $start;
		}else if($request == 'end'){
		    return $end;
		}
	}
}