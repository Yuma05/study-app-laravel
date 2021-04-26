<?php

namespace App\Http\Requests\Status;

use App\Models\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
            'material_id' => 'required|exists:materials,id',
            'quiz_score' => 'integer',
            'is_complete' => 'boolean',
        ];
    }

    public function makeStatus(): Status
    {
        $status = new Status;
        $status->fill($this->all());
        $status->user_id = Auth::id();
        return $status;
    }
}
