<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StaffPayment extends Model
{
    protected $table = "staff_payments";
    
    protected $fillable = [
      'staff_id', 
      'amount',
      'date', 
      'user_id'
    ];
    
    
}
