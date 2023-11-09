<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helper\MidtransController;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Helper\RegionController;
use App\Http\Controllers\Helper\ShippingController;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;

class CheckoutController extends Controller
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

        $provinces = RegionController::provinces();

        return view('pages.checkout', compact('carts', 'provinces'));
    }

    public function city($id)
    {
        return RegionController::city($id);
    }

    public function shipping($city, $courier)
    {
        $carts = Cart::where('user_id', auth()->user()->id)
            ->where('status', 'pending')
            ->get();
        
        $weight = 0;
        foreach($carts as $cart) {
            $weight += $cart->product->weight * $cart->quantity;
        }

        $weight = ($weight < 1) ? 1 : $weight;

        return ShippingController::shipping($city, $courier, $weight);
    }

    public function generate_id()
    {
        $order = Order::latest()->first();
        
        if($order) {
            $id = $order->id;
        }

        $str = 'ORD';
        $now = Carbon::now()->format('ymd');

        if(isset($id)) {
            $date = substr(explode('ORD', $id)[1], 0, 6);
            if($now == $date) {
                $number = (int) substr(explode('ORD', $id)[1], 6, 3);
                $number++;
            } else {
                $number = 1;
            }
        } else {
            $number = 1;
        }

        $order_id = $str.$now.sprintf("%03s", $number);

        return $order_id;
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $carts = Cart::where('user_id', auth()->user()->id)
            ->where('status', 'pending')
            ->get();
    
        $total = 0;
        foreach($carts as $cart) {
            $total += $cart->product->price * $cart->quantity;
        }

        $shipping_detail = json_encode(array(
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'province' => $request->province,
            'city' => $request->city,
            'address' => $request->address,
            'zip' => $request->zip,
        ));

        $order = new Order();
        $order->id = $this->generate_id();
        $order->user_id = auth()->user()->id;
        $order->order_amount = $total;
        $order->shipping_detail = $shipping_detail;
        $order->courier = $request->courier;
        $order->shipping_amount = $request->shipping_cost;
        $order->total_amount = $total + $request->shipping_cost;
        $order->save();

        foreach($carts as $cart) {
            $cart->status = 'checkout';
            $cart->save();

            $order_detail = new OrderDetail();
            $order_detail->order_id = $order->id;
            $order_detail->cart_id = $cart->id;
            $order_detail->total = $cart->quantity * $cart->product->price;
            $order_detail->save();
        }

        DB::commit();

        $token = MidtransController::midtrans($request->name, $request->email, $request->phone, $total + $request->shipping_cost);

        return redirect()->back()->with(['token' => $token, 'order' => $order]);
        try {
        } catch(\Exception $e) {
            return redirect()->back();
        }
    }
}
