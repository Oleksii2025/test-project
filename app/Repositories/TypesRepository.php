<?php

namespace App\Repositories;
use App\Models\Type;

class TypesRepository implements TypesRepositoryInterface
{
    /**
     * @return array
     */
    public function getAllTypes(): array
    {
        return Type::all()->toArray();
    }
}
