<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    public function productCreate()
    {
        $categorys = Category::all();
        $sub_categorys = SubCategory::all();
        return view('products.create_products',compact('categorys','sub_categorys'));
    }
    public function productInsert(Request $request)
    {
        $validateRequest = Validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        $product = Product::create([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'subcategory_id' => $request->input('subcategory_id'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
        ]);

        session()->flash('success', 'Product added successfully!');
        return redirect()->route('products');
    }
    public function products()
    {
        $products = Product::with('category', 'subcategory')->get();
        return view('products.view_product', compact('products'));
    }
    public function productEdit($id)
    {
        $sub_categorys = SubCategory::all();
        $categorys = Category::all();

        $product = Product::find($id);
        return view('products.create_products', compact('product','sub_categorys','categorys'));
    }
    public function productUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);
        $products = Product::find($id);
        $products->update([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'subcategory_id' => $request->input('subcategory_id'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
        ]);

        session()->flash('success', 'Product Update successfully!');
        return redirect()->route('products');
    }
    public function productDestroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        session()->flash('danger', 'Product Delete successfully!');
        return redirect()->back();
    }

}
