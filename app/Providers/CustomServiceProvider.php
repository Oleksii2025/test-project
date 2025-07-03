<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TasksService\TasksServiceInterface;
use App\Services\TasksService\TasksFactory\TasksFactoryInterface;
use App\Services\CategoriesService\CategoriesServiceInterface;
use App\Services\TypesService\TypesServiceInterface;
use App\Services\TasksService\TasksService;
use App\Services\TasksService\TasksFactory\TasksFactory;
use App\Services\CategoriesService\CategoriesService;
use App\Services\TypesService\TypesService;

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

    /**
     * @return void
     */
    private function registerServices(): void
    {
        $toBind = [
            TasksServiceInterface::class => TasksService::class,
            TasksFactoryInterface::class => TasksFactory::class,
            CategoriesServiceInterface::class => CategoriesService::class,
            TypesServiceInterface::class => TypesService::class,
        ];
        foreach ($toBind as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }
}
