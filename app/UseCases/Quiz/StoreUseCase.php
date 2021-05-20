<?php

namespace App\UseCases\Quiz;


class StoreUseCase
{
    public function invoke(array $quiz): array
    {
        // 質問の保存
        $quiz['question']->save();

        // 選択肢の保存
        foreach ($quiz['choices'] as $choice) {
            $choice->question_id = $quiz['question']->id;
            $choice->save();
        }

        return $quiz;
    }
}
