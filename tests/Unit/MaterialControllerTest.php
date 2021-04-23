<?php

namespace Tests\Unit;

use App\Http\Controllers\MaterialController;
use App\Http\Requests\Material\StoreRequest;
use App\Http\Requests\Material\UpdateRequest;
use App\UseCases\Material\DestroyUseCase;
use App\UseCases\Material\StoreUseCase;
use App\UseCases\Material\UpdateUseCase;
use Database\Seeders\CategoriesTableSeeder;
use Database\Seeders\MaterialsTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MaterialControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testIndex(): void
    {
        $this->seed(UsersTableSeeder::class);
        $this->seed(CategoriesTableSeeder::class);
        $this->seed(MaterialsTableSeeder::class);

        $controller = new MaterialController();
        $result = $controller->index(1);

        self::assertCount(1, $result);
        self::assertEquals('Material A', $result[0]['name']);
        self::assertEquals('Teaching Material A', $result[0]['content']);
    }

    public function testStore(): void
    {
        $this->seed(UsersTableSeeder::class);
        $this->seed(CategoriesTableSeeder::class);
        $this->seed(MaterialsTableSeeder::class);

        $request = new StoreRequest();
        $useCase = new StoreUseCase();
        $controller = new MaterialController();

        // requestにデータをマージ
        $request->merge([
            'name' => 'Material C',
            'content' => 'Teaching Material C',
            'category_id' => '1',
        ]);

        $result = $controller->store($request, $useCase);

        self::assertEquals('Material C', $result['name']);
        self::assertEquals('Teaching Material C', $result['content']);
        self::assertEquals('1', $result['category_id']);
    }

    public function testUpdate(): void
    {
        $this->seed(UsersTableSeeder::class);
        $this->seed(CategoriesTableSeeder::class);
        $this->seed(MaterialsTableSeeder::class);

        $request = new UpdateRequest();
        $useCase = new UpdateUseCase();
        $controller = new MaterialController();

        // requestにデータをマージ
        $request->merge([
            'id' => 1,
            'name' => 'Material X',
            'content' => 'Teaching Material X',
        ]);

        $result = $controller->update($request, $useCase);

        self::assertEquals('Material X', $result['name']);
        self::assertEquals('Teaching Material X', $result['content']);
    }

    public function testDestroy(): void
    {
        $this->seed(UsersTableSeeder::class);
        $this->seed(CategoriesTableSeeder::class);
        $this->seed(MaterialsTableSeeder::class);

        $useCase = new DestroyUseCase();
        $controller = new MaterialController();
        $id = 1;

        $result = $controller->destroy($id, $useCase);

        // 削除後に残っているMaterialを確認
        self::assertCount(0, $result);
    }
}
