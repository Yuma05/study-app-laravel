<?php

namespace App\UseCases\Material;

use App\Models\Material;

class UpdateUseCase
{
    public function invoke(Material $material): Material
    {
        $material->save();
        return $material;
    }
}
