<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderByDesc('id')->get();
        return view('admin.categories.index', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'name' => ['required', Rule::unique('categories')->ignore('categories'), 'max:50']
        ]);
        $slug = Str::slug($request->name, '-');
        $validated_data['slug'] = $slug;
        Category::create($validated_data);
        return redirect()->back()->with('message', "Category $slug Added Successfully");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validated_data = $request->validate([
            'name' => ['required', Rule::unique('categories')->ignore('categories'), 'max:50']
        ]);
        $slug = Str::slug($request->name, '-');
        $validated_data['slug'] = $slug;
        $category->update($validated_data);
        return redirect()->back()->with('message', "Categoria $slug Modificata");
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
        return redirect()->back()->with('message', "Categoria $category->name cancellata");
    }
}
