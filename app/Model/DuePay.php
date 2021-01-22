<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DuePay extends Model
{
    protected $fillable = [
    'ref',
    'description',
    'amount',
    'user_id',
    'date'
    ];
}
