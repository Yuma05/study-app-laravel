<?php

namespace App\Http\Requests\Quiz;

use App\Models\Choice;
use App\Models\Question;
use Illuminate\Foundation\Http\FormRequest;

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
            'content' => 'required|String',
            'explanation' => 'required|String',
            'material_id' => 'required|exists:materials,id',
            'choices.*.content' => 'required|String',
            'choices.*.is_answer' => 'required|boolean',
        ];
    }

    public function makeQuiz(): array
    {
        $question = new Question;
        $question->fill($this->all());

        $choices = array();

        foreach ($this->choices as $choice_data) {
            $choice = new Choice;
            $choice->fill($choice_data);
            $choices[] = $choice;
        }

        return ['question' => $question, 'choices' => $choices];
    }
}
