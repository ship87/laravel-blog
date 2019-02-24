<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\CategoriesResource;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryService $categoryService)
    {
        $categories = $categoryService->getPaginated('categories');

        return new CategoriesResource($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request, CategoryService $categoryService)
    {
		return $categoryService->create($request->get('attributes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, CategoryService $categoryService)
    {
        $category = $categoryService->getByIdOrFail($id);
        CategoryResource::withoutWrapping();

        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id, CategoryService $categoryService)
    {
        $attributes = $request->get('attributes');

        return $categoryService->update($attributes, $id, $attributes['updated_user_id']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, CategoryService $categoryService)
    {
		return $categoryService->destroy($id);
    }
}
