<?php

namespace App\Services\CategoriesService;

use App\Repositories\CategoriesRepositoryInterface;

class CategoriesService implements CategoriesServiceInterface
{
    /**
     * @param CategoriesRepositoryInterface $categoriesRepository
     */
    public function __construct(private CategoriesRepositoryInterface $categoriesRepository)
    {
    }

    /**
     * @return array
     */
    public function getAllCategories(): array
    {
        return $this->categoriesRepository->getAllCategories();
    }
}
