<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                'id' => 1,
                'quiz_score' => '100',
                'is_complete' => true,
                'user_id' => '1',
                'material_id' => '1',
            ],
            [
                'id' => 2,
                'quiz_score' => '50',
                'is_complete' => false,
                'user_id' => '1',
                'material_id' => '2',
            ],
        ];

        foreach ($statuses as $status) {
            Status::create($status);
        }
    }
}
