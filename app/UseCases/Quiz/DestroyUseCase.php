<?php

namespace App\UseCases\Quiz;


use App\Models\Question;

class DestroyUseCase
{
    public function invoke(int $id): int
    {
        $question = Question::find($id);
        $material_id = $question->material_id;
        $question->delete();
        return $material_id;
    }
}
