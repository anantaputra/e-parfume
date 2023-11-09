<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $json = json_decode($request->json);
    
            $transaction = new Transaction();
            $transaction->user_id = auth()->user()->id;
            $transaction->order_id = Order::where('uuid', $request->id)->first()->id;
            $transaction->transaction_id = $json->order_id;
            $transaction->gross_amount = $json->gross_amount;
            $transaction->method = $json->payment_type;
            $transaction->payment_code = $json->payment_code ?? null;
            $transaction->status = $json->transaction_status;
            $transaction->save();

            if($transaction->status == 'settlement') {
                $order = $transaction->order;
                foreach($order->details as $order) {
                    $product = Product::find($order->cart->product_id);
                    $product->stock = $product->stock - $order->cart->quantity;
                    $product->save();
                }
            }
    
            DB::commit();

            return redirect()->route('home');
        } catch(\Exception $e) {
            return redirect()->back();
        }
    }
}
