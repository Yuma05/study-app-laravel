<?php

namespace Tests\Unit;

use App\Http\Controllers\StatusController;
use App\Http\Requests\Status\StoreRequest;
use App\Http\Requests\Status\UpdateRequest;
use App\Models\Status;
use App\UseCases\Status\DestroyUseCase;
use App\UseCases\Status\StoreUseCase;
use App\UseCases\Status\UpdateUseCase;
use Database\Seeders\CategoriesTableSeeder;
use Database\Seeders\MaterialsTableSeeder;
use Database\Seeders\StatusesTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class StatusControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(UsersTableSeeder::class);
        $this->seed(CategoriesTableSeeder::class);
        $this->seed(MaterialsTableSeeder::class);
        $this->seed(StatusesTableSeeder::class);
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    public function testIndex(): void
    {
        Auth::loginUsingId(1);
        $controller = new StatusController();
        $result = $controller->index();

        self::assertCount(2, $result);
        self::assertEquals(100, $result[0]['quiz_score']);
        self::assertEquals(1, $result[0]['is_complete']);
    }

    public function testStore(): void
    {
        Auth::loginUsingId(1);
        $request = new StoreRequest();
        $useCase = new StoreUseCase();
        $controller = new StatusController();

        // requestにデータをマージ
        $request->merge([
            'quiz_score' => 50,
            'is_complete' => false,
            'material_id' => 1,
        ]);

        $result = $controller->store($request, $useCase);

        self::assertEquals(50, $result['quiz_score']);
        self::assertEquals(false, $result['is_complete']);
        self::assertEquals(1, $result['material_id']);

        $created_status = Status::find($result['id']);

        self::assertEquals(50, $created_status->quiz_score);
        self::assertEquals(false, $created_status->is_complete);
        self::assertEquals(1, $created_status->material_id);
    }

    public function testUpdate(): void
    {
        Auth::loginUsingId(1);
        $request = new UpdateRequest();
        $useCase = new UpdateUseCase();
        $controller = new StatusController();

        $target_id = 2;

        // requestにデータをマージ
        $request->merge([
            'id' => $target_id,
            'quiz_score' => '100',
            'is_complete' => true,
        ]);

        $result = $controller->update($request, $useCase);

        self::assertEquals(100, $result['quiz_score']);
        self::assertStringEndsWith(true, $result['is_complete']);

        $updated_status = Status::find($target_id);

        self::assertEquals(100, $updated_status->quiz_score);
        self::assertEquals(true, $updated_status->is_complete);
    }

    public function testDestroy(): void
    {
        Auth::loginUsingId(1);
        $useCase = new DestroyUseCase();
        $controller = new StatusController();
        $id = 1;

        $result = $controller->destroy($id, $useCase);

        // 削除後に残っているStatusを確認
        self::assertCount(1, $result);
        self::assertEquals(50, $result[0]['quiz_score']);
        self::assertEquals(false, $result[0]['is_complete']);

        $remain_status = Status::all();
        self::assertCount(1, $remain_status);
    }
}
