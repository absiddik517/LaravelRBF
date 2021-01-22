<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    protected $table = "parties";
    protected $guarded = [];
    
    public function PartyDetail(){
        return $this->hasOne('App\Model\PartyType', 'id', 'party_type');
    }
}
