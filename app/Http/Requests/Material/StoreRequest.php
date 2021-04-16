<?php

namespace App\Http\Requests\Material;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Material;

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
            'content' => 'required|String',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    public function makeMaterial(): Material
    {
        $material = new Material;
        $material->fill($this->all());
        return $material;
    }
}
