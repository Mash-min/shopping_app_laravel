<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductImage;
use App\Models\Product;

class ProductImagesController extends Controller
{
    
    public function create(Request $request)
    {
        $productImages = ProductImage::create($request->all());
        return response()->json(['product_image' => $productImages]);
    }

    public function update(Request $request, $id)
    {
        $productImage = ProductImage::find($id);
        $productImage->update($request->all());
        return response()->json(['product-image' => $productImage]);
    }

    public function delete($id)
    {
        ProductImage::find($id)->delete();
        return response()->json(['message' => 'Product Image Deleted']);
    }

}
