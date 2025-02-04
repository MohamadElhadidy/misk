<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
            'image' => 'image|required|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $image = $request->file('image')->storePublicly('categories');

            Category::create([
                'name' => $request->name,
                'image' => $image
            ]);

            DB::commit();

            return back()->with('success', 'Category created successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error('Something went wrong!', ['exception' => $th]);

            return back()->with('error', 'Something went wrong! Please try again.');
        }
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

        try {
            DB::beginTransaction();

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

            DB::commit();

            return back()->with('success', 'Category updated successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error('Something went wrong!', ['exception' => $th]);

            return back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            DB::beginTransaction();

            $category->delete();

            DB::commit();
            return back()->with('success', 'Category deleted successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error('Something went wrong!', ['exception' => $th]);

            return back()->with('error', 'Something went wrong! Please try again.');
        }
    }
}
