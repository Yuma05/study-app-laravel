<?php

namespace App\Http\Requests\Material;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Material;

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
        return [
            'name' => 'required_without:content|max:50',
            'content' => 'required_without:name|String',
        ];
    }

    public function updateMaterial(): Material
    {
        $material = Material::find($this->id);
        $material->fill($this->all());
        return $material;
    }
}
