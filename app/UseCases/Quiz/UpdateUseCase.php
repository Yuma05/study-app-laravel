<?php

namespace App\UseCases\Quiz;


use App\Models\Choice;

class UpdateUseCase
{
    public function invoke(array $quiz): array
    {
        // 質問の更新
        $quiz['question']->save();

        // 更新前の選択肢
        $past_choice_ids = Choice::where('question_id', $quiz['question']->id)->pluck('id')->toArray();

        // 選択肢の更新
        foreach ($quiz['choices'] as $choice) {
            $choice->question_id = $quiz['question']->id;
            $choice->save();
        }

        // 更新前の選択肢の削除
        Choice::destroy($past_choice_ids);

        return $quiz;
    }
}
