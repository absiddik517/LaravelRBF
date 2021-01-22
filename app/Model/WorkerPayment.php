<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WorkerPayment extends Model
{
    protected $table = "worker_payments";
    
    protected $fillable = [
      'worker_id', 
      'amount',
      'date', 
      'user_id'
    ];
}
