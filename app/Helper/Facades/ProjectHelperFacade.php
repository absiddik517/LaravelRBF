<?php

namespace App\Helper\Facades;
use Illuminate\Support\Facades\Facade;
class ProjectHelperFacade extends Facade{
    protected static function getFacadeAccessor(){
        return 'project_helper';
    }
}