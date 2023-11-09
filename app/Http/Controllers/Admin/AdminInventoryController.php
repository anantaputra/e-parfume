<?php

namespace App\Http\Controllers\Admin;

use App\Constans;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductInventory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminInventoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index()
    {
        $products = Product::all();
        return view('admin.pages.product.inventory.index', compact('products'));
    }

    public function history($id)
    {
        $product = Product::where('uuid', $id)->first();
        $inventories = ProductInventory::where('product_id', $product->id)->get();
        return view('admin.pages.product.inventory.history', compact('inventories'));
    }

    public function add($id)
    {
        $product = Product::where('uuid', $id)->first();
        return view('admin.pages.product.inventory.add', compact('product'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $product = Product::where('uuid', $request->id)->first();

            $inventory = new ProductInventory();
            $inventory->product_id = $product->id;
            $inventory->latest_stock = $product->stock;
            $inventory->quantity = $request->value;
            $inventory->adding = true;
            $inventory->save();

            $product->stock = $product->stock + $request->value;
            $product->save();

            DB::commit();

            return redirect()->route('admin.product.inventory')->with('success', Constans::SUCCESS_MSG);

        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $inventory = ProductInventory::where('uuid', $id)->first();
        return view('admin.pages.product.inventory.edit', compact('inventory'));
    }
    
    public function store_edit(Request $request)
    {
        try {
            DB::beginTransaction();

            $inventory = ProductInventory::where('uuid', $request->id)->first();
            $inventory->quantity = $request->value;
            $inventory->save();

            $product = Product::find($inventory->product_id);
            $product->stock = $inventory->latest_stock + $inventory->quantity;
            $product->save();

            DB::commit();

            return redirect()->route('admin.product.inventory')->with('success', Constans::SUCCESS_MSG);

        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();

            $inventory = ProductInventory::where('uuid', $id)->first();
            $inventory->delete();

            DB::commit();

            return redirect()->route('admin.product.inventory')->with('success', Constans::DELETE_MSG);

        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
}
