<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TypesService\TypesServiceInterface;

class TypesController extends Controller
{
    public function __construct(TypesServiceInterface $typesServiceInterface) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //
    }
}
