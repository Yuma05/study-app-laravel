<?php

namespace App\UseCases\Material;

use App\Models\Material;

class DestroyUseCase
{
    public function invoke(int $id): int
    {
        $material = Material::find($id);
        $category_id = $material->category_id;
        $material->delete();
        return $category_id;
    }
}
