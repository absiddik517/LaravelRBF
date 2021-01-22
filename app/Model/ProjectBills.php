<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\ProjectPayment;
class ProjectBills extends Model
{
    
    protected $table = "project_bills";
    protected $guarded = [];
    
    
    public function Payment(){
        return $this->hasMany('App\Model\ProjectPayment', 'project_bill_id', 'id');
    }
    
    
}
