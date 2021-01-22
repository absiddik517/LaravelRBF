<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DeleveryProduct extends Model
{
  protected $table = 'delevery_products';

  protected $fillable = [
    'ref',
    'd_ref',
    'quantity',
    'driver',
    'destination',
    'user_id',
    'date'
  ];
  
  public function sellsRel() {
    return $this->belongsTo('App\Model\Sells', 'ref', 'ref');
  }
}