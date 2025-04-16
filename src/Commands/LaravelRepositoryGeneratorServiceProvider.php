<?php

namespace RaviSaini\LaravelRepositoryGenerator;

use Illuminate\Support\ServiceProvider;
use RaviSaini\LaravelRepositoryGenerator\Commands\MakeRepository;

class LaravelRepositoryGeneratorServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeRepository::class,
            ]);
        }
    }
}
