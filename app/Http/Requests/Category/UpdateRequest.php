<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class UpdateRequest extends FormRequest
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
        // どちらかは必須
        return [
            'name' => 'required_without:file|max:50',
            'file' => 'required_without:name|image|mimes:jpeg,png,jpg',
        ];
    }

    public function updateCategory(): Category
    {
        $category = Category::find($this->id);
        $update_date = $this->all();
        if ($this->has('file')) {
            // 更新画像アップロード
            $upload_path = Storage::disk('s3')->putFile('category', $this->file, 'public');
            // 旧画像削除
            $delete_path = parse_url($category->image_src);
            Storage::disk('s3')->delete($delete_path);

            $update_date['image_src'] = Storage::disk('s3')->url($upload_path);
        }
        $category->fill($update_date);
        return $category;
    }
}
