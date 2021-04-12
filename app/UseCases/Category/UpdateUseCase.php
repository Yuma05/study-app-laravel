<?php

namespace App\UseCases\Category;

use App\Models\Category;

class UpdateUseCase
{
    public function invoke(Category $category): Category
    {
        $category->save();
        return $category;
    }
}
