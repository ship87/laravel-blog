<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use App\Traits\HttpPageTrait;

class CategoryController extends Controller
{
    use HttpPageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryService $categoryService, Request $request)
    {
        $categories = $categoryService->getPaginated(config('app.url_admin').'/categories');

        $this->isEmptyPaginated($categories, $request);

        return view(config('app.theme').'admin.categories.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryService $categoryService)
    {
        return view(config('app.theme').'admin.categories.create', [
            'categories' => $categoryService->getAllTitleId(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request, CategoryService $categoryService)
    {
        $categoryService->create($request->all());

        return redirect()->route(config('app.theme').'admin.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, CategoryService $categoryService)
    {
        $category = $categoryService->getByIdOrFail($id);

        return view(config('app.theme').'admin.categories.edit', [
            'category' => $category,
            'categories' => $categoryService->getAllTitleId($category),
            'selectedCategories' => $categoryService->getId($category),
        ]);
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
        $categoryService->update($request->all(), $id);

        return redirect()->route(config('app.theme').'admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, CategoryService $categoryService)
    {
        $categoryService->destroy($id);

        return redirect()->route(config('app.theme').'admin.categories.index');
    }
}
