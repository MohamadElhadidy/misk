<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->check()) {
            // Logged-in users: Fetch from database
            $wishlist = auth()->user()->wishlist()->get();
        } else {
            // Guest users: Fetch from session
            $wishlistIds = Session::get('wishlist', []);
            $wishlist = Product::whereIn('id', $wishlistIds)->get();
        }


        return view('wishlist.index', compact('wishlist'));
    }

    public function store(Request $request)
    {
        $product = Product::find($request->product_id);
        if (!$product) {
            return response()->json(["success" => false, 'error' => 'Product not found'], 404);
        }


        try {
            DB::beginTransaction();
            if (auth()->check()) {
                $wishlist = Wishlist::where('user_id', $request->user_id)
                    ->where('product_id', $request->product_id)
                    ->first();

                if ($wishlist) {
                    // For logged-in users: Add to database
                    $wishlist->delete();
                } else {
                    Wishlist::create([
                        'user_id' => $request->user_id,
                        'product_id' => $product->id,
                    ]);
                }
            } else {

                $wishlist = Session::get('wishlist') ?? [];

                if (in_array($request->product_id, $wishlist)) {
                    $wishlist = array_diff($wishlist, [$request->product_id]);
                } else {
                    $wishlist[] = $request->product_id;
                }

                Session::put('wishlist', $wishlist);
            }



            DB::commit();

            return back()->with('success', 'Wishlist  success!');
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error('Something went wrong!', ['exception' => $th]);

            return back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function destroy(Request $request)
    {

        $product = Product::find($request->product_id);
        if (!$product) {
            return back()->with('error', 'Product not found.');
        }


        try {
            DB::beginTransaction();

            if (auth()->check()) {
                // For logged-in users: Remove from the database.
                $wishlistItem = Wishlist::where('user_id', auth()->user()->id)
                    ->where('product_id', $request->product_id)
                    ->first();

                if ($wishlistItem) {
                    $wishlistItem->delete();
                } else {
                    DB::rollBack();
                    return back()->with('error', 'Product is not in your wishlist.');
                }
            } else {
                // For guest users: Remove from the session.
                $wishlist = Session::get('wishlist', []);
                if (in_array($request->product_id, $wishlist)) {
                    // Remove the product ID from the wishlist array.
                    $wishlist = array_diff($wishlist, [$request->product_id]);
                    Session::put('wishlist', $wishlist);
                } else {
                    DB::rollBack();
                    return back()->with('error', 'Product is not in your wishlist.');
                }
            }

            // Commit the transaction
            DB::commit();

            return back()->with('success', 'Product removed from wishlist successfully!');
        } catch (\Throwable $th) {
            // Rollback in case of any error.
            DB::rollBack();
            Log::error('Error removing product from wishlist', ['exception' => $th]);

            return back()->with('error', 'Something went wrong! Please try again.');
        }
    }
}
