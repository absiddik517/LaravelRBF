<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sells extends Model
{
  protected $table = 'sells';
  protected $fillable = [
    'ref',
    'name',
    'address',
    'product',
    'quality',
    'rate',
    'quantity',
    'total',
    'paid',
    'due'
    ];

  public function product() {
    return $this->hasOne('App\Model\Products', 'id', 'product_id');
  }
  
  public function delevery(){
    return $this->hasMany('App\Model\DeleveryProduct', 'ref', 'ref');
  }
  
  public function duePay(){
    return $this->hasMany('App\Model\DuePay', 'ref', 'ref');
  }
}