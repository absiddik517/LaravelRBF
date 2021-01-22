<?php

namespace App\Helper;

use Illuminate\Support\Facades\Auth;
use App\Model\Users;
use App\Model\Company;

class Dates{
    
    
    public function __construct(){
        $this->Today();
    }
    
    public static function Today(){
        $id = Auth::user()->id;
        $data = Users::where('id', $id)->first();
        $user_date = $data['system_date'];
        if($user_date !== null){
            $today = $user_date;
        }else{
            $today = date('Y-m-d');
        }
        
        return $today;
    }
    
    public static function UserDate(){
        $format = 'm-d-Y';
        $id = Auth::user()->id;
        $data = Users::where('id', $id)->first();
        $user_date = $data['system_date'];
        $output = date($format, strtotime($user_date));
        if($user_date !== null){
            return $output;
        }else{
            return '';
        }
    }
    
    public function DB($date){
        return date('Y-m-d', strtotime($date));
    }
    
    public function SR($date){
        return date('d-m-Y', strtotime($date));
    }
    
    public function PreviusDate($today){
        return date('Y-m-d', strtotime("$today - 1 Day"));
    }
    
    public function Next($today){
        return date('Y-m-d', strtotime("$today + 1 Day"));
    }

    public function AppDate(){
        $data = Company::where('init', 'Start_Date')->first();
        return $data['config'];
    }
    
    
    
}



