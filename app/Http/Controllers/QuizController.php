<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Models\Question;
use App\UseCases\Quiz\DestroyUseCase;
use App\UseCases\Quiz\StoreUseCase;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Requests\Quiz\StoreRequest;
use App\UseCases\Quiz\UpdateUseCase;
use App\Http\Requests\Quiz\UpdateRequest;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $material_id
     * @return AnonymousResourceCollection
     */
    public function index(int $material_id)
    {
        // 教材に紐付いているクイズの取得
        return QuestionResource::collection(Question::where('material_id', $material_id)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @param StoreUseCase $useCase
     * @return QuestionResource
     */
    public function store(StoreRequest $request, StoreUseCase $useCase)
    {
        $quiz = $request->makeQuiz();
        $created = $useCase->invoke($quiz);
        return new QuestionResource($created['question']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param UpdateUseCase $useCase
     * @return QuestionResource
     */
    public function update(UpdateRequest $request, UpdateUseCase $useCase)
    {
        $quiz = $request->updateQuiz();
        $updated = $useCase->invoke($quiz);
        return new QuestionResource($updated['question']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param DestroyUseCase $useCase
     * @return AnonymousResourceCollection
     */
    public function destroy(int $id, DestroyUseCase $useCase)
    {
        // 削除されたQuestionのmaterial_id
        $deleted_material_id = $useCase->invoke($id);
        return QuestionResource::collection(Question::where('material_id', $deleted_material_id)->get());
    }
}
