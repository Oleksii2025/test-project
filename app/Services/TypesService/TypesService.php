<?php

namespace App\Services\TypesService;
use App\Repositories\TypesRepositoryInterface;

class TypesService implements TypesServiceInterface
{
    /**
     * @param TypesRepositoryInterface $typesRepository
     */
    public function __construct(private TypesRepositoryInterface $typesRepository) {}

    /**
     * @return array
     */
    public function getAllTypes(): array
    {
        return $this->typesRepository->getAllTypes();
    }
}
