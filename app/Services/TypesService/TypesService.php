<?php

namespace App\Services\TypesService;
use App\Repositories\TypesRepository\TypesRepositoryInterface;

class TypesService implements TypesServiceInterface
{
    public function __construct(TypesRepositoryInterface $typesRepositoryInterface) {}

    public function getAllTypes(): array
    {
         
    }
}