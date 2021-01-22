<?php

namespace App\Helper\Facades;
use Illuminate\Support\Facades\Facade;
class DateFacade extends Facade{
    protected static function getFacadeAccessor(){
        return 'dates';
    }
}