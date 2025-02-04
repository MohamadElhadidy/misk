<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $featured = Product::where('featured', 1)->get();

        return view('products.show', compact('product', 'featured'));
    }

}
