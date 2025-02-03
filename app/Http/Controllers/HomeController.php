<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $categories= Category::all();
        $products = Product::limit(10)->get();
        $featured = Product::where('featured', 1)->get();

        return view('home', compact('categories', 'products', 'featured'));
    }
}
