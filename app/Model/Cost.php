<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $fillable = [
        'description', 'amount', 'user_id', 'date',
    ];
    
    
    public function author(){
      return $this->belongsTo('App\Model\Users', 'user_id', 'id');
    }
}
