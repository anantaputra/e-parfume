<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $transactions = Transaction::where('status', 'settlement')->get();
        $revenues = $transactions->sum('gross_amount');
        $orders = Order::whereIn('status', ['shipping', 'done'])->count();
        $products = Product::count();
        $users = User::all();
        $customers = array();

        foreach($users as $user) {
            if($user->roles[0]->name != 'admin') {
                $customers[] = $user;
            }
        }

        $customers = count($customers);

        return view('admin.pages.dashboard', compact('revenues', 'orders', 'products', 'customers'));
    }
}
