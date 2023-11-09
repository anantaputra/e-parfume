<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $orders = Order::where('status', 'pending')->get();

        return view('admin.pages.order.index', compact('orders'));
    }

    public function processing()
    {
        $orders = Order::where('status', 'shipping')->get();

        return view('admin.pages.order.processing', compact('orders'));
    }

    public function history()
    {
        $orders = Order::where('status', 'done')->get();

        return view('admin.pages.order.history', compact('orders'));
    }

    public function view($id)
    {
        $order = Order::where('uuid', $id)->first();

        return view('admin.pages.order.detail', compact('order'));
    }

    public function tracking($id)
    {
        $order = Order::where('uuid', $id)->first();

        return view('admin.pages.order.tracking', compact('order'));
    }

    public function store_tracking(Request $request)
    {
        try {
            DB::beginTransaction();

            $order = Order::where('uuid', $request->uuid)->first();
            $order->tracking_number = $request->tracking;
            $order->status = 'shipping';
            $order->save();

            foreach($order->details as $order) {
                $order->status = 'shipping';
                $order->save();
            }

            DB::commit();

            return redirect()->route('admin.order');
        } catch(\Exception $e) {
            return redirect()->back();
        }
    }
}
