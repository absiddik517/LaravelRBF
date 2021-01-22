<?php

namespace App\Providers;
use App\Helper\Money;
use Illuminate\Support\ServiceProvider;

class MoneyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        return $this->app->bind('money', function(){
            return new Money;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
