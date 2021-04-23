<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Auth::loginUsingId(2);

        $questions = [
            [
                'content' => 'Question 1',
                'explanation' => 'Explanation for Question1',
                'material_id' => '1',
            ],
            [
                'content' => 'Question 2',
                'explanation' => 'Explanation for Question2',
                'material_id' => '1',
            ],
        ];

        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}
