<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = "projects";
    protected $guarded = [];
    
    public function Bills(){
        return $this->hasMany('App\Model\ProjectBills', 'project_id', 'id');
    }
    
    public function Deliveries(){
        return $this->hasMany('App\Model\ProjectDelevery', 'project_id', 'id');
    }
    
    public function Payment(){
        return $this->hasMany('App\Model\ProjectPayment', 'project_id', 'id');
    }
    
    public function Sells(){
        return $this->hasMany('App\Model\ProjectSell', 'project_id', 'id');
    }
}
