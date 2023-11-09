<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::all();
        
        return view('pages.shop.index', compact('products'));
    }

    public function single($slug)
    {
        $product = Product::where('slug', $slug)->first();
        
        return view('pages.shop.single', compact('product'));
    }
}
