<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
  protected $table = 'staff';
  protected $fillable = [
    'name',
    'address',
    'phone',
    'designation',
    'selery',
    'user_id',
  ];


  public function author() {
    return $this->belongsTo('App\Model\Users', 'user_id', 'id');
  }
}