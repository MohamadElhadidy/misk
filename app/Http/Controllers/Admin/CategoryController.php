<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->has('q')) {
            $categories = Category::where('name', 'like', '%' . request('q') . '%')->paginate(5);
        } else {
            $categories = Category::paginate(5);
        }

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'unique:categories|required|max:255',
            'image' => 'image|required',
        ]);

        $image = $request->file('image')->storePublicly('categories');

        Category::create([
            'name' => $request->name,
            'image' => $image
        ]);

        return back()->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated =  $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $category->id
        ]);

        if ($request->image) {
            $request->validate([
                'image' => 'image'
            ]);

            $image = $request->file('image')->storePublicly('categories');

            Storage::delete($category->image);

            $category->update([
                'name' => $request->name,
                'image' => $image
            ]);
        } else {
            $category->update($validated);
        }



        return back()->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with('success', 'Category deleted successfully!');
    }
}
