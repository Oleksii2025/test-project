<?php

namespace App\Services\CategoriesService;
use App\Repositories\CategoriesRepository\CategoriesRepositoryInterface;

class CategoriesService implements CategoriesServiceInterface
{
    public function __construct(CategoriesRepositoryInterface $categoriesRepositoryInterface) {}

    public function getAllCategories(): array
    {
         
    }
}