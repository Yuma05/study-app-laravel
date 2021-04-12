<?php

namespace App\UseCases\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class DestroyUseCase
{
    public function invoke(int $id): Category
    {
        $category = Category::find($id);

        // 画像削除
        $delete_path = parse_url($category->image_src);
        Storage::disk('s3')->delete($delete_path);

        $category->delete();
        return $category;
    }
}
