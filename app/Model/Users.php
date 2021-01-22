<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';

    public function UserRule()
    {
        return $this->hasOne('App\Model\RulesModel', 'id', 'rule_id');
    }

    public function Permissions()
    {
    	return $this->hasOne('App\Model\Permissions', 'rule_id', 'id');
    }

}
