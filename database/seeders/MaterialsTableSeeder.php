<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;

class MaterialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Auth::loginUsingId(2);

        $materials = [
            [
                'id' => 1,
                'name' => 'Material A',
                'content' => 'Teaching Material A',
                'category_id' => '1',
            ],
            [
                'id' => 2,
                'name' => 'Material B',
                'content' => 'Teaching Material B',
                'category_id' => '2',
            ],
        ];

        foreach ($materials as $material) {
            Material::create($material);
        }
    }
}
