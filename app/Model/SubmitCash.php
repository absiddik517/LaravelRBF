<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubmitCash extends Model
{
    protected $table = 'submit_cash';
    protected $fillable = [
        'owner_id', 'description', 'amount', 'user_id', 'date',
    ];
    
    
    public function author(){
      return $this->belongsTo('App\Model\Users', 'user_id', 'id');
    }
}
