<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
  
    public function create(Request $request)
    {
        $product = Product::create($request->all());
        return response()->json(['product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return response()->json(['product' => $product]);
    }

    public function delete($id)
    {
        Product::find($id)->delete();
        return response()->json(['message' => 'Product Deleted']);
    }

    public function find($slug)
    {
        $product = Product::with('images')->with('tags')->where(['slug' => $slug])->first();
        return response()->json(['product' => $product]);
    }

    public function products()
    {
        $products = Product::orderBy('created_at', 'ASC')->with('images')->with('tags')->paginate(8);
        return response()->json(['products' => $products]);
    }

}
