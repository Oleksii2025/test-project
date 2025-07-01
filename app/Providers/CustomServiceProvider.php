<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TasksService\TasksServiceInterface;
use App\Services\TasksService\CategoriesServiceInterface;
use App\Services\TasksService\TasksService;
use App\Services\TasksService\CategoriesService;



class CustomServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerServices();
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

    private function registerServices(): void
    {
        $toBind = [
            TasksServiceInterface::class => TasksService::class,
            CategoriesServiceInterface::class => CategoriesService::class,
        ];
        foreach ($toBind as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }
}
