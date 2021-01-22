<?php

namespace App\Helper;
use App\Model\Sells;
use App\Model\DuePay;
use App\Model\Outcash;
use App\Model\ProjectPayment;
use App\Model\ProjectAdvance;

// expences models
use App\Model\Cost;
use App\Model\SubmitCash;
use App\Model\DealerPayment;    
use App\Model\PartyDailyAdvance;
use App\Model\StaffPayment;
use App\Model\WorkerPayment;

use Dates;


class Money{
    
    public function Cash($today ='', $start_day=''){
        if($today == '') $today = Dates::Today();
        return $this->PreviousCash() + $this->NetIncome($today, $start_day) - $this->NetCost($today, $start_day);
    }
    
    public function PreviousCash($today = ''){
        if($today == '') $today = Dates::Today();
        $pre = Dates::PreviusDate($today);
        $first = Dates::AppDate();
        return $this->NetIncome($pre, $first) - $this->NetCost($pre, $first);
    }
    
    public function NetCost($today='', $start_day=''){
        if($today == '') $today = Dates::Today();
        return $this->Cost($today, $start_day) + 
            $this->SubmitCash($today, $start_day) + 
            $this->DealerPayment($today, $start_day) + 
            $this->PartyDailyAdvance($today, $start_day) + 
            $this->StaffPayment($today, $start_day) + 
            $this->WorkerPayment($today, $start_day);
    }
    
    public function NetIncome($today='', $start_day=''){
        if($today == '') $today = Dates::Today();
        return $this->PaidSell($today, $start_day) + 
            $this->DuePay($today, $start_day) + 
            $this->ProjectPayments($today, $start_day) + 
            $this->ProjectAdvances($today, $start_day) + 
            $this->Outcash($today, $start_day);
    }
    
    public function NetIncomeWPA($today='', $start_day=''){
        if($today == '') $today = Dates::Today();
        return $this->PaidSell($today, $start_day) + 
            $this->DuePay($today, $start_day) + 
            $this->ProjectPayments($today, $start_day) + 
            $this->ProjectAdvances($today, $start_day) + 
            $this->Outcash($today, $start_day) +
            $this->PreviousCash($today);
    }
    
    public function IncomeWithPreviousCash($today='', $start_day=''){
        return $this->PreviousCash() + $this->NetIncome();
    }
    
    
    public function PaidSell($today='', $start_day=''){
        if($today == '') $today = Dates::Today();
        
        if($start_day == '') 
        return Sells::where('date', '=', $today)->sum('paid');
        return Sells::whereBetween('date', [$start_day, $today])->sum('paid');
    }
    
    public function ProjectPayments($today='', $start_day=''){
        if($today == '') $today = Dates::Today();
        
        if($start_day == '') 
        return ProjectPayment::where('date', '=', $today)->sum('amount');
        return ProjectPayment::whereBetween('date', [$start_day, $today])->sum('amount');
    }
    
    public function ProjectAdvances($today='', $start_day=''){
        if($today == '') $today = Dates::Today();
        
        if($start_day == '') 
        return ProjectAdvance::where('date', '=', $today)->sum('amount');
        return ProjectAdvance::whereBetween('date', [$start_day, $today])->sum('amount');
    }
    
    public function DuePay($today='', $start_day = ''){
        if($today ==''){
            $today = Dates::Today();
        }
        if($start_day == '') return DuePay::where('date', '=', $today)->sum('amount');
        return DuePay::whereBetween('date', [$start_day, $today])->sum('amount');
    }
    
    public function Outcash($today='', $start_day = ''){
        if($today ==''){
            $today = Dates::Today();
        }
        if($start_day == '') return Outcash::where('date', '=', $today)->sum('amount');
        return Outcash::whereBetween('date', [$start_day, $today])->sum('amount');
    }
    
    
    // costs 
    
    public function SubmitCash($today='', $start_day = ''){
        if($today ==''){
            $today = Dates::Today();
        }
        if($start_day == '') return SubmitCash::where('date', '=', $today)->sum('amount');
        return SubmitCash::whereBetween('date', [$start_day, $today])->sum('amount');
    }
    
    public function Cost($today='', $start_day = ''){
        if($today ==''){
            $today = Dates::Today();
        }
        if($start_day == ''){
            return Cost::where('date', '=', $today)->sum('amount');
        }else{
            return Cost::whereBetween('date', [$start_day, $today])->sum('amount');
        }
    }
    
    public function DealerPayment($today='', $start_day = ''){
        if($today ==''){
            $today = Dates::Today();
        }
        if($start_day == ''){
            return DealerPayment::where('date', '=', $today)->sum('amount');
        }else{
            return DealerPayment::whereBetween('date', [$start_day, $today])->sum('amount');
        }
    }
    
    
    
    public function PartyDailyAdvance($today='', $start_day = ''){
        if($today ==''){
            $today = date('Y-m-d');
        }
        if($start_day == ''){
            return PartyDailyAdvance::where('date', '=', $today)->sum('amount');
        }else{
            return PartyDailyAdvance::whereBetween('date', [$start_day, $today])->sum('amount');
        }
    }
    
    public function StaffPayment($today='', $start_day = ''){
        if($today == '') $today = date('Y-m-d');
        if($start_day == ''){
            return StaffPayment::where('date', $today)->sum('amount');
        }else{
            return StaffPayment::whereBetween('date', [$start_day, $today])->sum('amount');
        }
    }
    
    public function WorkerPayment($today='', $start_day = ''){
        if($today ==''){
            $today = date('Y-m-d');
        }
        if($start_day == ''){
            return WorkerPayment::where('date', '=', $today)->sum('amount');
        }else{
            return WorkerPayment::whereBetween('date', [$start_day, $today])->sum('amount');
        }
    }
    
    // helpers 
    
    public static function _p(int $num, int $p, $action=''){
        $value = $num * ($p/100);
        if($action == ''){
            return $value;
        }else if($action == 'a'){
            return $num + $value;
        }else if($action == 'm'){
            return $num - $value;
        }
    }
    
    public function Round($num){
        return round($num);
    }
    
    
    
    
    
}