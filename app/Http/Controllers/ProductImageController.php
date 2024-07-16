<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Validator;

class ProductImageController extends Controller
{
    public function productCreateImage()
    {
        $products = Product::all();
        return view('product_image.create_fileupload', compact('products'));
    }
    public function productInsertImage(Request $request)
    {
        $validateRequest = Validator::make($request->all(), [
            'product_id' => 'required',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' 
        ]);

        $product = Product::findOrFail($request->input('product_id'));
      
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/product_images', $filename);

                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                // $productImage->image = 'storage/product_images/' . $filename;
                $productImage->image = $filename;
                $productImage->save();
            }
        }
        session()->flash('success', 'Product Images added successfully!');

        return redirect()->route('productsImage');
    }
    public function productsImage()
    {
        $productImages = ProductImage::all();
        return view('product_image.view_product_image', compact('productImages'));
    }
    public function productsImageEdit($id)
    {
        $products = Product::all();
        $productImage = ProductImage::find($id);
        return view('product_image.create_fileupload', compact('products','productImage'));
    }
    
    public function productsImageUpdate(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Allow multiple images
        ]);
        $productImage = ProductImage::findOrFail($id);
        $product = Product::findOrFail($request->input('product_id'));
    
        $productImage->product_id = $product->id;

   
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/product_images', $filename);
                $productImage->image = $filename;
                $productImage->save();
            }
        }
        $productImage->save();
        session()->flash('success', 'Product Image updated successfully!');
        return redirect()->route('productsImage');
    }


    public function productsImageDestroy($id)
    {
        $productImages = ProductImage::find($id);
        $productImages->delete();
        session()->flash('danger', 'Product Iamge Delete successfully!');
        return redirect()->back();
    }



}
