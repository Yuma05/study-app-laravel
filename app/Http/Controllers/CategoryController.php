<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Category[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Category::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $category = new Category;

        // 画像アップロード
        $upload_path = Storage::disk('s3')->putFile('category', $request->file, 'public');

        // 絶対パスで保存
        $category->image_src = Storage::disk('s3')->url($upload_path);

        $category->name = $request->name;
        $category->save();

        return redirect('api/category');
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Category::find($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        // 更新画像アップロード
        $upload_path = Storage::disk('s3')->putFile('category', $request->file, 'public');
        $category->image_src = Storage::disk('s3')->url($upload_path);

        // 旧画像削除
        $delete_path = parse_url($category->image_src);
        Storage::disk('s3')->delete($delete_path);

        $category->name = $request->name;
        $category->save();

        return redirect('api/category/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        // 画像削除
        $delete_path = parse_url($category->image_src);
        Storage::disk('s3')->delete($delete_path);

        $category->delete();
        return redirect('api/category');
    }
}
