<?php

namespace CrudPackage;

use Illuminate\Support\ServiceProvider;
use CrudPackage\Console\{MakeCrudCommand};

class CrudPackageServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->commands([
                MakeCrudCommand::class,
            ]);

//            $this->loadViewsFrom(__DIR__.'/resources/views', 'crudpackage');
//
//            $this->publishes([
//                __DIR__.'/resources/views' => resource_path('views/vendor/crudpackage'),
//            ], 'views');
        }

    }
}
