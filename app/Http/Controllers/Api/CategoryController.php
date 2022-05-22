<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

// this file is created with this command
// php artisan make:controller Api/CategoryController --resource --api --model=Category

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Category::select('id', 'name')->get() -- better performance
        // Category::all() -- meh performance
        // CategoryResource is used to transform something, not to hide something
        return CategoryResource::collection(Category::select('id', 'name')->get());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexV2()
    {
        return Category::select('id', 'name')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        return new CategoryResource(Category::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        // under the hood route model binding
        // $category = Category::findOrFail($id)

        // ================================================

        // customise error without route model binding
        // $category = Category::find($id);

        // if (!$category) {
        //     abort(404, 'Category not found!');
        // }

        // ================================================

        // customise error globally in handlerPHP

        // ================================================

        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->noContent();
    }
}
