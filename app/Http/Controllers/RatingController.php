<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Rating;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    public function ratingCreate()
    {
        $products = Product::all();
        return view('ratings.create_ratings',compact('products'));
    }
    public function ratingtInsert(Request $request)
    {
        $validateRequest = Validator::make($request->all(), [
            'product_id' => 'required',
            'customer_name' => 'required',
            'star' => 'required',
            'review' => 'required',
        ]);

        if ($validateRequest->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validateRequest->errors()
            ], 403);
        }

        $rating = Rating::create([
            'product_id' => $request->input('product_id'),
            'customer_name' => $request->input('customer_name'),
            'star' => $request->input('star'),
            'review' => $request->input('review'),
        ]);

        session()->flash('success', 'rating added successfully!');
        return response()->json(['message' => 'Rating created successfully', 'rating' => $rating], 201);
        return redirect()->route('ratings');
    }
    public function ratings()
    {
        $ratings = Rating::with('product')->get();
        return response()->json([
            'success' => true,
            'message' => 'Rating Data successfully',
            'result' => $ratings
        ], 200);
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
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'customer_name' => 'required',
            'star' => 'required',
            'review' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation fails',
                'error' => $validator->errors()
            ], 401);
        }

        $ratings = Rating::find($id);

        if (is_null($ratings)) {
            return response()->json(['message' => 'Rating not found'], 404);
        }

        $ratings->update([
            'product_id' => $request->input('product_id'),
            'customer_name' => $request->input('customer_name'),
            'star' => $request->input('star'),
            'review' => $request->input('review'),
        ]);

        session()->flash('success', 'Rating Update successfully!');
        return response()->json([
            'message' => 'User updated successfully',
            'user' => $ratings,
        ], 200);
        return redirect()->route('ratings');
    }
    public function ratingDestroy($id)
    {
        $ratings = Rating::find($id);
        if (!$ratings) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $ratings->delete();
        session()->flash('danger', 'Rating Delete successfully!');
        return response()->json(['message' => 'Rating deleted successfully']);
        return redirect()->back();
    }
  
   
}
