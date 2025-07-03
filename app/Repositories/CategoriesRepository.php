<?php

namespace App\Repositories;
use App\Models\Category;

class CategoriesRepository implements CategoriesRepositoryInterface
{
    /**
     * @return array
     */
    public function getAllCategories(): array
    {
        return Category::all()->toArray();
    }
}
