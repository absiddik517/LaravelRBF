<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Preload extends Model
{
    protected $table = 'preloads';
    protected $guarded = [];
    
    public function Items(){
        return $this->hasOne('App\Model\Item', 'id', 'item_id');
    }
}
