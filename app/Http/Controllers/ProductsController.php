<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddProductRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class ProductsController extends Controller
{
  
    public function create(AddProductRequest $request)
    {
        $product = Product::create($request->all());
        return response()->json([
            'product' => $product
        ]);
    }

    public function update(Request $request, $slug)
    {
        $product = Product::where(['slug' => $slug])->with('images')->first();
        $product->update($request->all());
        return response()->json(['product' => $product]);
    }

    public function delete($slug)
    {
        $product = Product::where(['slug' => $slug])->first();
        Storage::deleteDirectory('/public/images/products/'.$product->slug);
        $product->delete();
        return response()->json(['message' => 'Product Deleted']);
    }

    public function find($slug)
    {
        $product = Product::with('images')
                          ->with('tags')
                          ->with('categories.category')
                          ->where(['slug' => $slug])
                          ->first();
        return response()->json(['product' => $product]);
    }

    public function products($paginate, $status)
    {
        $products = Product::orderBy('created_at', 'DESC')
                            ->where(['status' => $status])
                            ->with('images')
                            ->with('tags')
                            ->with('categories.category')
                            ->paginate($paginate);
        return response()->json(['products' => $products]);
    }

    public function archiveProduct($slug) 
    {
        $product = Product::where(['slug' => $slug])->first();
        $product->update(['status' => 'archived']);
        return response()->json(['product' => $product]);
    }
    
    public function restoreProduct($slug) 
    {
        $product = Product::where(['slug' => $slug])->first();
        $product->update(['status' => 'active']);
        return response()->json(['product' => $product]);
    }

}
