<?php

namespace App\Http\Controllers;

use App\Http\Requests\Status\StoreRequest;
use App\Http\Requests\Status\UpdateRequest;
use App\Http\Resources\StatusResource;
use App\Models\Status;
use App\UseCases\Status\DestroyUseCase;
use App\UseCases\Status\StoreUseCase;
use App\UseCases\Status\UpdateUseCase;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        // 同一カテゴリーの Material を返す
        return StatusResource::collection(Status::where('user_id', Auth::id())->get());
    }

    /**
     * Display a listing of the resource.
     *
     * @param int $user_id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index_admin(int $user_id)
    {
        // 同一カテゴリーの Material を返す
        return StatusResource::collection(Status::where('user_id', $user_id)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @param StoreUseCase $useCase
     * @return StatusResource
     */
    public function store(StoreRequest $request, StoreUseCase $useCase)
    {
        $status = $request->makeStatus();
        $created = $useCase->invoke($status);
        return new StatusResource($created);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param UpdateUseCase $useCase
     * @return StatusResource
     */
    public function update(UpdateRequest $request, UpdateUseCase $useCase)
    {
        // Status の user_id が認証ユーザと同一か確認
        $this->authorize('update', Status::find($request->id));
        $status = $request->updateStatus();
        $created = $useCase->invoke($status);
        return new StatusResource($created);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param DestroyUseCase $useCase
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(int $id, DestroyUseCase $useCase)
    {
        // Status の user_id が認証ユーザと同一か確認
        $this->authorize('delete', Status::find($id));
        // 削除されたStatusのuser_id
        $deleted_user_id = $useCase->invoke($id);
        return StatusResource::collection(Status::where('user_id', $deleted_user_id)->get());
    }
}
