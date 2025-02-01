<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

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
            ]);


            for ($i=0; $i < count($request->sizes); $i++) {
                ProductSize::create([
                    'product_id' => $product->id,
                    'size' => $request->sizes[$i],
                    'price' => $request->prices[$i],
                ]);
            }


            for ($i = 0; $i < count($request->images); $i++) {
                $path = $request->images[$i]->storePublicly('products');


                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $path,
                ]);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
