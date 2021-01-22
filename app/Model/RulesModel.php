<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RulesModel extends Model
{
    protected $table = 'rules';

    public function PermissionRel()
    {
    	return $this->hasOne('App\Model\Permissions', 'rule_id', 'id');
    }
}
