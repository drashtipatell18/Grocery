<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

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
        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
        ]);

        $carts = Cart::create([
            'user_id'      => $request->input('user_id'),
            'product_id'     => $request->input('product_id'),
            'quantity'  => $request->input('quantity'),
        ]);

        session()->flash('success', 'Cart added successfully!');
        return redirect()->route('carts');
    }

    public function carts()
    {
        $carts = Cart::all();
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
        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
        ]);

        $cart = Cart::find($id);

        $cart->update([
            'user_id' => $request->input('user_id'),
            'product_id' => $request->input('product_id'),
            'quantity' => $request->input('quantity'),
        ]);

        session()->flash('success', 'Cart Update successfully!');
        return redirect()->route('carts');
    }

    public function cartDestroy($id)
    {
        $carts = Cart::find($id);
        $carts->delete();
        session()->flash('danger', 'Cart Delete successfully!');
        return redirect()->back();
    }

}
