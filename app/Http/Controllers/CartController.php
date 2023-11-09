<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $carts = Cart::where('user_id', auth()->user()->id)
            ->where('status', 'pending')
            ->get();

        return view('pages.cart', compact('carts'));
    }

    public function add(Request $request)
    {
        try {
            DB::beginTransaction();

            $cart = new Cart();
            $cart->user_id = auth()->user()->id;
            $cart->product_id = Product::where('uuid', $request->product)->first()->id;
            $cart->quantity = $request->quantity;
            $cart->save();

            DB::commit();
    
            return redirect()->route('cart');
        } catch(\Exception $e) {
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();

            $cart = Cart::where('uuid', $id)->first();
            $cart->delete();

            DB::commit();
    
            return redirect()->route('cart');
        } catch(\Exception $e) {
            return redirect()->back();
        }
    }
}
