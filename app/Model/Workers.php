<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Workers extends Model
{
    protected $table = "workers";
    
    protected $fillable = [
      'name',  
      'address',
      'phone',
      'selery',
      'user_id'
    ];
    
    public function author(){
      return $this->belongsTo('App\Model\Users', 'id', 'user_id');
    }
}
