<?php

namespace App\Helper\Facades;
use Illuminate\Support\Facades\Facade;
class PartyHelperFacade extends Facade{
    protected static function getFacadeAccessor(){
        return 'ProjectHelper';
    }
}