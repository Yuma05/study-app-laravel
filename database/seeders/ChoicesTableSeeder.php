<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Choice;
use Illuminate\Support\Facades\Auth;

class ChoicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Auth::loginUsingId(2);

        $choices = [
            [
                'content' => '○',
                'question_id' => '1',
                'is_answer' => false,
            ],
            [
                'content' => '☓',
                'question_id' => '1',
                'is_answer' => true,
            ],
            [
                'content' => 'Choice 1',
                'question_id' => '2',
                'is_answer' => false,
            ],
            [
                'content' => 'Choice 2',
                'question_id' => '2',
                'is_answer' => true,
            ],
            [
                'content' => 'Choice 3',
                'question_id' => '2',
                'is_answer' => false,
            ],
        ];

        foreach ($choices as $choice) {
            Choice::create($choice);
        }
    }
}
