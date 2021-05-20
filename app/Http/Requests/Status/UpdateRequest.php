<?php

namespace App\Http\Requests\Status;

use App\Models\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
            'material_id' => 'exists:materials,id',
            'quiz_score' => 'integer',
            'is_complete' => 'boolean',
        ];
    }

    public function updateStatus(): Status
    {
        $status = Status::find($this->id);
        $status->fill($this->all());
        return $status;
    }
}
