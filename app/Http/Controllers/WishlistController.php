<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function wishlistCreate()
    {
        $users = User::all();
        $products = Product::all();
        return view('wishlist.create_wishlist', compact('users', 'products'));
    }

    public function wishlistInsert(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
        ]);

        $wishlist = Wishlist::create([
            'user_id'      => $request->input('user_id'),
            'product_id'     => $request->input('product_id'),
        ]);

        session()->flash('success', 'WishList added successfully!');
        return redirect()->route('wishlists');
    }
    public function wishlists()
    {
        $wishlists = Wishlist::all();
        return view('wishlist.view_wishlist', compact('wishlists'));
    }

    public function wishlistEdit($id)
    {
        $users = User::all();
        $products = Product::all();
        $wishlist = Wishlist::find($id);
        return view('wishlist.create_wishlist', compact('wishlist','users','products'));
    }

    public function wishlistUpdate(Request $request,$id)
    {
        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
        ]);

        $wishlist = Wishlist::find($id);

        $wishlist->update([
            'user_id' => $request->input('user_id'),
            'product_id' => $request->input('product_id'),
        ]);

        session()->flash('success', 'Wishlist Update successfully!');
        return redirect()->route('wishlists');
    }

    public function wishlistDestroy($id)
    {
        $wishlist = Wishlist::find($id);
        $wishlist->delete();
        session()->flash('danger', 'Wishlist Delete successfully!');
        return redirect()->back();
    }

}
