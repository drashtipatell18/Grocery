<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    public function ratingCreate()
    {
        $products = Product::all();
        return view('ratings.create_ratings',compact('products'));
    }
    public function ratingtInsert(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'customer_name' => 'required',
            'star' => 'required',
            'review' => 'required',
        ]);

        $rating = Rating::create([
            'product_id' => $request->input('product_id'),
            'customer_name' => $request->input('customer_name'),
            'star' => $request->input('star'),
            'review' => $request->input('review'),
        ]);

        session()->flash('success', 'rating added successfully!');
        return redirect()->route('ratings');
    }
    public function ratings()
    {
        $ratings = Rating::with('product')->get();
        return view('ratings.view_ratings', compact('ratings'));
    }
    public function ratingEdit($id)
    {
        $products = Product::all();
        $rating = Rating::find($id);
        return view('ratings.create_ratings', compact('rating','products'));
    }
    public function ratingUpdate(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required',
            'customer_name' => 'required',
            'star' => 'required',
            'review' => 'required',
        ]);

        $ratings = Rating::find($id);

        $ratings->update([
            'product_id' => $request->input('product_id'),
            'customer_name' => $request->input('customer_name'),
            'star' => $request->input('star'),
            'review' => $request->input('review'),
        ]);

        session()->flash('success', 'Rating Update successfully!');
        return redirect()->route('ratings');
    }
    public function ratingDestroy($id)
    {
        $ratings = Rating::find($id);
        $ratings->delete();
        session()->flash('danger', 'Rating Delete successfully!');
        return redirect()->back();
    }
  
   
}
