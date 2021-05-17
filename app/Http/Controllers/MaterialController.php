<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Http\Resources\MaterialResource;
use App\Http\Requests\Material\StoreRequest;
use App\UseCases\Material\StoreUseCase;
use App\Http\Requests\Material\UpdateRequest;
use App\UseCases\Material\UpdateUseCase;
use App\UseCases\Material\DestroyUseCase;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class MaterialController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param int $category_id
     * @return AnonymousResourceCollection
     */
    public function index(int $category_id)
    {
        // 同一カテゴリーの Material を返す
        return MaterialResource::collection(Material::where('category_id', $category_id)->get());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return MaterialResource
     */
    public function show(int $id)
    {
        return new MaterialResource(Material::find($id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @param StoreUseCase $useCase
     * @return MaterialResource
     */
    public function store(StoreRequest $request, StoreUseCase $useCase)
    {
        $material = $request->makeMaterial();
        $created = $useCase->invoke($material);
        return new MaterialResource($created);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param UpdateUseCase $useCase
     * @return MaterialResource
     */
    public function update(UpdateRequest $request, UpdateUseCase $useCase)
    {
        $material = $request->updateMaterial();
        $created = $useCase->invoke($material);
        return new MaterialResource($created);
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
        // 削除されたMaterialのcategory_id
        $deleted_category_id = $useCase->invoke($id);
        return MaterialResource::collection(Material::where('category_id', $deleted_category_id)->get());
    }
}
