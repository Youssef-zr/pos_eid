<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\category\CategoryRequest;
use App\Models\Category;
use Astrotomic\Translatable\Locales;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_categories'])->only(['index']);
        $this->middleware(['permission:create_categories'])->only(['create', 'store']);
        $this->middleware(['permission:update_categories'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_categories'])->only(['destroy']);
    }

    public function index()
    {
        $title = trans('lang.categories_list');
        $categories = Category::withCount('products')->get();

        return view('dashboard.views.categories.index', compact('categories', "title"));
    }


    public function create()
    {
        $title = trans('lang.categories_new');
        $locale_langs = app(Locales::class)->all();

        return view("dashboard.views.categories.create", compact('title', "locale_langs"));
    }


    public function store(CategoryRequest $request)
    {
        $newCategory = new Category();
        $newCategory->fill($request->all())->save();

        return redirect_with_flash('msgSuccess', trans('lang.record_added_successfully'), "categories");
    }


    public function edit(Category $category)
    {
        $title = trans('lang.categories_new');
        $locale_langs = app(Locales::class)->all();

        return view('dashboard.views.categories.update', compact('category', "title", "locale_langs"));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->fill($request->all())->save();

        return redirect_with_flash('msgSuccess', trans('lang.record_updated_successfully'), "categories");
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect_with_flash('msgSuccess', trans('lang.record_deleted_successfully'), "categories");
    }
}
