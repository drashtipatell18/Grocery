<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function cartCreate()
    {
        $users = User::all();
        $products = Product::all();
      
        return view('carts.create_cart', compact('users', 'products'));
    }

    public function cartInsert(Request $request)
    {
        $validateRequest = Validator::make($request->all(), [
            'user_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
        ]);

        if ($validateRequest->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validateRequest->errors()
            ], 403);
        }

        $carts = Cart::create([
            'user_id'      => $request->input('user_id'),
            'product_id'     => $request->input('product_id'),
            'quantity'  => $request->input('quantity'),
        ]);

        session()->flash('success', 'Cart added successfully!');
        return response()->json(['message' => 'Cart Created successfully', 'carts' => $carts], 201);
        return redirect()->route('carts');
    }

    public function carts()
    {
        $carts = Cart::all();
        return response()->json([
            'success' => true,
            'message' => 'Users Data successfully',
            'result' => $carts
        ], 200);
        return view('carts.view_cart', compact('carts'));
    }

    public function cartEdit($id)
    {
        $users = User::all();
        $products = Product::all();
        $cart = Cart::find($id);
        return view('carts.create_cart', compact('cart','users','products'));
    }

    public function cartUpdate(Request $request,$id)
    {
        $validateRequest = Validator::make($request->all(), [
            'user_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
        ]);

        if ($validateRequest->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validateRequest->errors()
            ], 403);
        }

        $cart = Cart::find($id);

        if (is_null($cart)) {
            return response()->json(['message' => 'Cart not found'], 404);
        }


        $cart->update([
            'user_id' => $request->input('user_id'),
            'product_id' => $request->input('product_id'),
            'quantity' => $request->input('quantity'),
        ]);

        session()->flash('success', 'Cart Update successfully!');
        return response()->json([
            'message' => 'Cart updated successfully',
            'cart' => $cart,
        ], 200);
        return redirect()->route('carts');
    }

    public function cartDestroy($id)
    {
        $carts = Cart::find($id);
        if (!$carts) {
            return response()->json(['message' => 'Cart not found'], 404);
        }
        $carts->delete();
        session()->flash('danger', 'Cart Delete successfully!');
        return response()->json(['message' => 'Cart deleted successfully']);
        return redirect()->back();
    }

}
