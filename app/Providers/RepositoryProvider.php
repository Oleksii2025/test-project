<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\TasksRepositoryInterface;
use App\Repositories\CategoriesRepositoryInterface;
use App\Repositories\TypesRepositoryInterface;
use App\Repositories\TasksRepository;
use App\Repositories\CategoriesRepository;
use App\Repositories\TypesRepository;


class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
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

    /**
     * @return void
     */
    public function registerRepositories(): void
    {
        $toBind = [
            TasksRepositoryInterface::class => TasksRepository::class,
            CategoriesRepositoryInterface::class => CategoriesRepository::class,
            TypesRepositoryInterface::class => TypesRepository::class,
        ];
        foreach ($toBind as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }
}
