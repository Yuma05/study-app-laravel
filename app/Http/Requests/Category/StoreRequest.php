<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'file' => 'required|image|mimes:jpeg,png,jpg',
        ];
    }

    public function makeCategory(): Category
    {
        $category = new Category;
        $update_date = $this->all();

        // 画像アップロード
        $upload_path = Storage::disk('s3')->putFile('category', $this->file, 'public');
        // 絶対パス取得
        $update_date['image_src'] = Storage::disk('s3')->url($upload_path);

        $category->fill($update_date);
        return $category;
    }
}
