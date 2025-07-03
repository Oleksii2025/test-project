<?php

namespace App\Http\Controllers;

use App\Services\CategoriesService\CategoriesServiceInterface;

class CategoriesController extends Controller
{
    /**
     * @param CategoriesServiceInterface $categoriesService
     */
    public function __construct(private CategoriesServiceInterface $categoriesService)
    {
    }

    /**
     * @return object|\Illuminate\Http\JsonResponse
     */
    public function index(): object
    {
        $data = $this->categoriesService->getAllCategories();

        return response()->json(['data' => $data], 200);
    }
}
