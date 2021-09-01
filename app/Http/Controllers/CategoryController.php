<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Category\CreateRequest;
use App\Http\Requests\Category\UpdateRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return view('admin.categories.index',compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CreateRequest $request)
    {
        Category::Create($request->validated());
        return redirect()->route('categories.index');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show',compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit',compact('category'));
    }

    public function update(UpdateRequest $request, Category $category)
    {
        $category->update($request->validated());
        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
