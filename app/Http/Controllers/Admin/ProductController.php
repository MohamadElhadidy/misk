<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
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
            dd($th);
        }




        //begin transacyiom
        //insert product
        //insert price and sizes
        //insert images

    }

    private function cleanTempFiles()
    {
        $tempPath = storage_path('app/temp');
        if (file_exists($tempPath)) {
            array_map('unlink', glob("$tempPath/*"));
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


            if($newImages){
            try {
                foreach ($newImages as $base64Image) {
                    $image = $this->base64ToUploadedFile($base64Image);

                    $path = $image->store('products');

                    ProductImage::create([
                        'product_id' => $product->id,
                        'path' => $path,
                    ]);
                }
            } finally {
                $this->cleanTempFiles();
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




        //begin transacyiom
        //insert product
        //insert price and sizes
        //insert images

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

    private function base64ToUploadedFile($base64String)
    {
        // Extract image data
        $imageData = explode(',', $base64String);
        $imageContent = base64_decode($imageData[1]);

        // Determine file extension
        $mimeType = explode(':', explode(';', $imageData[0])[0])[1];
        $extension = explode('/', $mimeType)[1];

        // Create a unique filename
        $filename = Str::random(40) . '.' . $extension;

        // Store the file in Laravel's temporary directory
        $tempPath = storage_path('app/temp/' . $filename);
        file_put_contents($tempPath, $imageContent);

        // Create UploadedFile instance
        return new UploadedFile(
            $tempPath,
            $filename,
            $mimeType,
            null,
            true // Keep the original file
        );
    }
}
