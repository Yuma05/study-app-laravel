<?php

namespace Tests\Unit;

use App\Http\Controllers\CategoryController;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\UseCases\Category\DestroyUseCase;
use App\UseCases\Category\StoreUseCase;
use App\UseCases\Category\UpdateUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testIndex(): void
    {
        $this->seed();

        $controller = new CategoryController();
        $result = $controller->index();

        self::assertCount(2, $result);
        self::assertEquals('Category A', $result[0]['name']);
        self::assertEquals('https://picsum.photos/id/1015/300/300', $result[0]['image_src']);
    }

    public function testShow(): void
    {
        $this->seed();

        $controller = new CategoryController();
        $result = $controller->show(1);

        self::assertEquals('Category A', $result['name']);
        self::assertEquals('https://picsum.photos/id/1015/300/300', $result['image_src']);
    }

    public function testStore(): void
    {
        $this->seed();

        $request = new StoreRequest();
        $useCase = new StoreUseCase();
        $controller = new CategoryController();

        // requestにデータをマージ
        $request->merge([
            'name' => 'Category C',
            'file' => $this->faker->image(),
        ]);

        $result = $controller->store($request, $useCase);

        self::assertEquals('Category C', $result['name']);
        self::assertStringEndsWith('.png', $result['image_src']);
    }

    public function testUpdate(): void
    {
        $this->seed();

        $request = new UpdateRequest();
        $useCase = new UpdateUseCase();
        $controller = new CategoryController();

        // requestにデータをマージ
        $request->merge([
            'id' => 1,
            'name' => 'Category X',
            'file' => $this->faker->image(),
        ]);

        $result = $controller->update($request, $useCase);

        self::assertEquals('Category X', $result['name']);
        self::assertStringEndsWith('.png', $result['image_src']);
    }

    public function testDestroy(): void
    {
        $this->seed();

        $useCase = new DestroyUseCase();
        $controller = new CategoryController();
        $id = 1;

        $result = $controller->destroy($id, $useCase);

        // 削除後に残っているカテゴリーを確認
        self::assertCount(1, $result);
        self::assertEquals('Category B', $result[0]['name']);
        self::assertEquals('https://picsum.photos/id/1036/300/300', $result[0]['image_src']);
    }
}
