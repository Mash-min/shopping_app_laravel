<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductImage;
use App\Models\Product;

class ProductImagesController extends Controller
{
    
    public function create(Request $request)
    {
        foreach($request->image as $image) {
            // ============= NAMING THE IMAGE =================
            $imageName = 'product-image-'.rand().$request->product_id.time().'.png';
            // ============= SAVING THE IMAGE NAME TO DB =================
            ProductImage::create($request->except('image') + [
                'image' => $imageName
            ]);
            // ============= SAVES THE IMAGE TO STORAGE =================
            $image->storeAs('/public/images/products/', $imageName);
        }
        return response()->json(['message' => 'Updload Success']);
    }

    public function update(Request $request, $productSlug)
    {
        $product = Product::where(['slug' => $productSlug])->first();
        // ============= REMOVES IMAGES FROM DB & STORAGE =================
        foreach($product->images()->get() as $image) {
            Storage::delete('/public/images/products/'.$image->image);
        }
        $product->images()->delete();
        // ============= UPLOADS NEW IMAGES TO DB & STORAGE =================
        return response()->json(['message' => 'Images updated']);
    }

    public function delete($id)
    {
        ProductImage::find($id)->delete();
        return response()->json(['message' => 'Product Image Deleted']);
    }

}
