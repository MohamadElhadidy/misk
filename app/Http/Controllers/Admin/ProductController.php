<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->has('q')) {
            $products = Product::where('name', 'like', '%' . request('q') . '%')->paginate(5);
        } else {
            $products = Product::paginate(5);
        }


        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //    dd($request->all());

        //validate product data (name - category - descriprion)
        //validate price and sizes
        //validate images


        try {
            DB::beginTransaction();

            $product = Product::create([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'featured' => $request->featured
            ]);


            for ($i = 0; $i < count($request->sizes); $i++) {
                ProductSize::create([
                    'product_id' => $product->id,
                    'size' => $request->sizes[$i],
                    'price' => $request->prices[$i],
                ]);
            }


            if ($request->has('images')) {
                try {
                    // Process images
                    foreach ($request->input('images') as $base64Image) {
                        // Convert base64 to UploadedFile instance
                        $image = $this->base64ToUploadedFile($base64Image);

                        // Store the image
                        $path = $image->store('products');

                        ProductImage::create([
                            'product_id' => $product->id,
                            'path' => $path,
                        ]);
                    }

                    // Process other data...

                } finally {
                    // Clean up temporary files
                    $this->cleanTempFiles();
                }
            }




            DB::commit();

            return back()->with('success', 'Product created successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error('Something went wrong!', ['exception' => $th]);

            return back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function show(Product $product)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // dd($request->all());

        try {
            DB::beginTransaction();

            $product->update([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'featured' => $request->featured
            ]);



            $existingImages = array_filter($request->images, function ($image) {
                return strpos($image, 'products/') === 0;
            }) ?? [];



            $deletedImages = $product->images()
                ->whereNotIn('path', $existingImages)
                ->get();


            foreach ($deletedImages as $image) {
                Storage::delete('public/' . $image->image_path);
                $image->delete();
            }


            $newImages = array_diff($request->images, $existingImages) ?? [];


            if ($newImages) {
                try {
                    foreach ($newImages as $base64Image) {
                        $image = Helper::base64ToUploadedFile($base64Image);

                        $path = $image->store('products');

                        ProductImage::create([
                            'product_id' => $product->id,
                            'path' => $path,
                        ]);
                    }
                } finally {
                    Helper::cleanTempFiles();
                }
            }





            // Find sizes to delete (sizes in database but not in the new data)
            $deletedSizes = $product->sizes()->whereNotIn('id', $request->size_ids)->get();

            foreach ($deletedSizes as $size) {
                $size->delete();
            }


            for ($i = 0; $i < count($request->sizes); $i++) {
                $size_id = $request->size_ids[$i];
                if ($size_id) {
                    $size = $product->sizes()->find($size_id);
                    if ($size) {
                        $size->update([
                            'size' => $request->sizes[$i],
                            'price' => $request->prices[$i],
                        ]);
                    }
                } else {
                    ProductSize::create([
                        'product_id' => $product->id,
                        'size' => $request->sizes[$i],
                        'price' => $request->prices[$i],
                    ]);
                }
            }

            DB::commit();

            return back()->with('success', 'Product updated successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        $product->images()->delete();
        $product->sizes()->delete();

        return back()->with('success', 'Product deleted successfully!');
    }
}
