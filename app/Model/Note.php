<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';
    protected $gaurded = [];
    protected $fillable = ['user_id', 'note'];
}
