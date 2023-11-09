<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\FilesController;
use Illuminate\Support\Facades\DB;

class AdminProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $products = Product::all();
        return view('admin.pages.product.index', compact('products'));
    }

    public function add()
    {
        return view('admin.pages.product.add');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
    
            $fragrances = explode(",", $request->fragrances);
            $data = array();
            foreach($fragrances as $fragrance) {
                $data[] = $fragrance;
            }
    
            $fragrances = json_encode($data);
    
            $product = new Product();
            $product->name = $request->name;
            $product->category_id = 1;
            $product->price = $request->price;
            $product->size = $request->size;
            $product->weight = $request->weight;
            $product->box = $request->box;
            $product->fragrances = $fragrances;
            $product->description = $request->description;
            if($request->hasFile('image')) {
                $path = 'products';
                $filePath = FilesController::uploadFile($request->file('image'), $path);
                $product->images = json_encode([$filePath]);
            }
            $product->save();
    
            DB::commit();
    
            return redirect()->route('admin.product');
        } catch(\Exception $e) {
            return redirect()->back();
        }
    }

    public function edit($slug)
    {
        $product = Product::findBySlug($slug);

        return view('admin.pages.product.edit', compact('product'));
    }

    public function store_edit(Request $request)
    {
        try {
            DB::beginTransaction();
    
            $fragrances = explode(",", $request->fragrances);
            $data = array();
            foreach($fragrances as $fragrance) {
                $data[] = $fragrance;
            }
    
            $fragrances = json_encode($data);
    
            $product = Product::findBySlug($request->slug);
            $product->name = $request->name;
            $product->category_id = 1;
            $product->price = $request->price;
            $product->size = $request->size;
            $product->weight = $request->weight;
            $product->box = $request->box;
            $product->fragrances = $fragrances;
            $product->description = $request->description;
            if($request->hasFile('image')) {
                $path = 'products';
                $filePath = FilesController::uploadFile($request->file('image'), $path);
                $product->images = json_encode([$filePath]);
            }
            $product->save();
    
            DB::commit();
    
            return redirect()->route('admin.product');
        } catch(\Exception $e) {
            return redirect()->back();
        }
    }

    public function delete($slug)
    {
        try {
            DB::beginTransaction();

            $product = Product::findBySlug($slug);
            $product->delete();

            DB::commit();

            return redirect()->route('admin.product');
        } catch(\Exception $e) {
            return redirect()->back();
        }
    }
}
