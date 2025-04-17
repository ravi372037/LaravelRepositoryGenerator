<?php

namespace LaravelRepositoryGenerator;

use Illuminate\Support\ServiceProvider;
use LaravelRepositoryGenerator\Commands\MakeRepository;

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
