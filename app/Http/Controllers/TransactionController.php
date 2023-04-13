<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TransactionController extends Controller
{
    public function checkout()
    {
        $carts =  Cart::all();

        if ($carts == null) {
            return Redirect::back();
        }

        $transaction = Transaction::create([]);

        foreach ($carts as $cart) {
            $product = Product::find($cart->product_id);

            $product->update([
                'stock' => $product->stock - $cart->qty
            ]);

            TransactionDetail::create([
                'qty' => $cart->qty,
                'transaction_id' => $transaction->id,
                'product_id' => $cart->product_id
            ]);

            $cart->delete();
        }
        return redirect('/');
    }

    public function index()
    {
        $transactions = Transaction::all();
        return view('transaction/index', compact(['transactions']));
    }

    public function show_detail(Transaction $transaction)
    {
        return view('transaction/show_detail', compact('transaction'));
    }
}
