<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Categories\StoreCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('categories.index')->with('categories', Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category->fill($request->only('name'));
        $category->save();

        Session::flash('success', 'Category created successfully!');
        return Redirect::to(route('categories.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Category $category)
    {
        return view('categories.create')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->only('name'));
        $category->save();

        Session::flash('success', 'Category updated successfully!');
        return Redirect::to(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        Session::flash('success', 'Category deleted successfully!');
        return Redirect::to(route('categories.index'));
    }
}
