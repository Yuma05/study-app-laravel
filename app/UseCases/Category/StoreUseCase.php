<?php

namespace App\UseCases\Category;

use App\Models\Category;

class StoreUseCase
{
    public function invoke(Category $category): Category
    {
        $category->save();
        return $category;
    }
}
