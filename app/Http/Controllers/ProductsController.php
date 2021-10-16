<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddProductRequest;
use App\Models\Product;

class ProductsController extends Controller
{
  
    public function create(AddProductRequest $request)
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

    public function delete($slug)
    {
        Product::where(['slug' => $slug])->first()->delete();
        return response()->json(['message' => 'Product Deleted']);
    }

    public function find($slug)
    {
        $product = Product::with('images')->with('tags')->where(['slug' => $slug])->first();
        return response()->json(['product' => $product]);
    }

    public function products($paginate)
    {
        $products = Product::orderBy('created_at', 'ASC')->with('images')->with('tags')->paginate($paginate);
        return response()->json(['products' => $products]);
    }

}
