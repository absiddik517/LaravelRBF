<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PartyBill extends Model
{
    protected $table = 'party_bill';
    protected $guarded = [];
    
    public function Payment(){
        return $this->hasMany('App\Model\ProjectPayment', 'project_bill_id', 'id');
    }
}
