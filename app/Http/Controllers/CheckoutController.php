<?php

namespace App\Http\Controllers;

use App\Mail\NewOrder;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\UserAddress;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function index(Request $request) {

        if (auth()->check()) {
            $carts = Cart::where('user_id', auth()->id())->get();
        } else {
            $carts = collect(session()->get('cart', []));
        }

        if ($carts->isEmpty()) return redirect('/');

        $totalQuantity = 0;
        $totalPrice = 0;
        $cart = [];

            // Process database cart
            foreach ($carts as $item) {
                $product = Product::find($item->product_id);
                $size = ProductSize::find($item->product_size_id);
                $quantity = $item->quantity;


                $cart[] = [
                    'id' => $item->id,
                    'product' => $product,
                    'size' => $size,
                    'quantity' => $quantity,
                ];

                $totalQuantity += $quantity;
                $totalPrice += $quantity * $size->price;
            }


        return view('checkout.index', compact('cart', 'totalPrice', 'totalQuantity'));
    }

    public function store(Request $request){
        //create new address if address = new

        try {
            DB::beginTransaction();
            if($request->address == 'new') {
                //validate address
                $request->validate([
                    'country' => 'required',
                    'city' => 'required',
                    'address_line_1' => 'required',
                    'phone_number' => 'required',
                    'postal_code' => 'required',
                ]);

                $address = UserAddress::create([
                    'user_id' => auth()->id(),
                    'country' => $request->country,
                    'city' => $request->city,
                    'address_line_1' => $request->address_line_1,
                    'address_line_2' => $request->address_line_2,
                    'phone_number' => $request->phone_number,
                    'postal_code' => $request->postal_code,
                ]);
            }else{
                $address = UserAddress::find($request->address);
            }
            //create new order
            $order = Order::create([
                'user_id' => auth()->id(),
                'address_id' => $address->id,
                'total_price' => $request->total_price,
                'status' => 'pending',
            ]);
            //convert $cart to array
            $request->cart = json_decode($request->cart, true);

            //create new order detail
            foreach ($request->cart as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']['id'],
                    'size' => $item['size']['size'],
                    'price' => $item['size']['price'],
                    'quantity' => $item['quantity'],
                ]);
            }
            //delete cart
            if (auth()->check()) {
                Cart::where('user_id', auth()->id())->delete();
            } else {
                session()->forget('cart');
            }

            DB::commit();

            Mail::to([$order->customer->email, env('ADMIN_MAIL')])->send(new NewOrder($order));

            return redirect()->route('checkout.success');
        }catch (\Throwable $th) {
            DB::rollBack();

            Log::error('Something went wrong!', ['exception' => $th]);

            return redirect()->back();
        }

    }
}
