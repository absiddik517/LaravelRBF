<?php

namespace App\Helper\Facades;
use Illuminate\Support\Facades\Facade;
class MoneyFacade extends Facade{
    protected static function getFacadeAccessor(){
        return 'money';
    }
}