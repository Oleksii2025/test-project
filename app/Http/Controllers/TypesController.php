<?php

namespace App\Http\Controllers;

use App\Services\TypesService\TypesServiceInterface;

class TypesController extends Controller
{
    /**
     * @param TypesServiceInterface $typesService
     */
    public function __construct(private TypesServiceInterface $typesService)
    {
    }

    /**
     * @return object|\Illuminate\Http\JsonResponse
     */
    public function index(): object
    {
        $data = $this->typesService->getAllTypes();

        return response()->json(['data' => $data], 200);
    }
}
