<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helper\Dates;
use App\Helper\Controller\ProjectHelper;
use App\Helper\Controller\PartyHelper;

class DateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->DateService();
        $this->ProjectServiceProvider();
        $this->PartyServiceProvider();
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
    
    private function DateService(){
        return $this->app->bind('dates', function(){
            return new Dates;
        });
    }
    
    private function ProjectServiceProvider(){
        return $this->app->bind('project_helper', function(){
            return new ProjectHelper;
        });
    }
    
    private function PartyServiceProvider(){
        return $this->app->bind('ProjectHelper', function(){
            return new PartyHelper;
        });
    }
    
}
