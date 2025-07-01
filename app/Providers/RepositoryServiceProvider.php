<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\TasksRepositoryInterface;
use App\Repositories\CategoriesRepositoryInterface;
use App\Repositories\TasksRepository;
use App\Repositories\CategoriesRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register() :void
    {
        $this->registerRepositories();
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

    public function registerRepositories() :void
    {
        $toBind = [
            TasksRepositoryInterface::class => TasksRepository::class,
            CategoriesRepositoryInterface::class => CategoriesRepository::class,
        ];
        foreach ($toBind as $interface => $implementation){
            $this->app->bind($interface, $implementation);
        }
    }
}
