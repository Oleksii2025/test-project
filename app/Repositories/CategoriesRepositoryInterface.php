<?php

namespace App\Http\Repositories;

interface CategoriesRepositoryInterface
{
    public function getAllCategories(): array;
}