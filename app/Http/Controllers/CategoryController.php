<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\UseCases\Category\StoreUseCase;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\UseCases\Category\UpdateUseCase;
use App\UseCases\Category\DestroyUseCase;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @param StoreUseCase $useCase
     * @return CategoryResource
     */
    public function store(StoreRequest $request, StoreUseCase $useCase)
    {
        $category = $request->makeCategory();
        $created = $useCase->invoke($category);
        return new CategoryResource($created);
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return CategoryResource
     */
    public function show(int $id)
    {
        return new CategoryResource(Category::find($id));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param UpdateUseCase $useCase
     * @return CategoryResource
     */
    public function update(UpdateRequest $request, UpdateUseCase $useCase)
    {
        $category = $request->updateCategory();
        $created = $useCase->invoke($category);
        return new CategoryResource($created);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param DestroyUseCase $useCase
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function destroy(int $id, DestroyUseCase $useCase)
    {
        $useCase->invoke($id);
        return CategoryResource::collection(Category::all());
    }
}
