<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add_toCart(Product $product, Request $request)
    {
        $product_id = $product->id;

        $existing_cart = Cart::where('product_id', $product_id)->first();

        if ($existing_cart == null) {

            // validasi request
            $request->validate([
                'qty' => 'required|gte:1|lte:' . $product->stock
            ]);

            // create cart
            Cart::create([
                'product_id' => $product_id,
                'qty' => $request->qty
            ]);
        } else {
            // validasi agar kuantitas pada cart tidak melebihi stock produk
            $request->validate([
                'qty' => 'required|gte:1|lte:' . ($product->stock - $existing_cart->qty)
            ]);

            $existing_cart->update([
                'qty' => $existing_cart->qty + $request->qty
            ]);
        }

        return redirect('/');
    }

    public function show_cart()
    {
        $carts = Cart::all();
        return view('cart/index', compact(['carts']));
    }

    public function update_cart(Cart $cart, Request $request)
    {
        // validasi request
        $request->validate([
            'qty' => 'required|gte:1|lte:' . $cart->product->stock
        ]);

        $cart->update([
            'qty' => $request->qty
        ]);

        return redirect('/cart');
    }

    public function delete_cart(Cart $cart)
    {
        $cart->delete();
        return redirect('/cart');
    }
}
