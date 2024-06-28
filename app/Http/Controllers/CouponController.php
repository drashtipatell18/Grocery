<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function coupon()
    {
        $coupons = Coupon::all();
        return view('coupon.view_coupon', compact('coupons'));
    }
    public function couponCreate()
    {
        return view('coupon.create_coupon');
    }
    public function couponInsert(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'coupon_code' => 'required',
            'discount' => 'required',
            'discount_type' => 'required|in:percentage,fixed_amount',
            'start_date' => 'required',
            'expiry_date' => 'required',
            'minimum_order_amount' => 'required',
        ]);
        $filename = '';

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images', $filename);
        }
        $coupon = Coupon::create([
            'name'      => $request->input('name'),
            'coupon_code'  => $request->input('coupon_code'),
            'coupon_description'  => $request->input('coupon_description'),
            'discount'  => $request->input('discount'),
            'discount_type'  => $request->input('discount_type'),
            'start_date'  => $request->input('start_date'),
            'expiry_date'  => $request->input('expiry_date'),
            'minimum_order_amount'  => $request->input('minimum_order_amount'),
            'image' => $filename,
        ]);

        session()->flash('success', 'Coupon added successfully!');
        return redirect()->route('coupon');
    }
    public function couponEdit($id)
    {
        $coupon = Coupon::find($id);
        return view('coupon.create_coupon', compact('coupon'));
    }
    public function couponUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'coupon_code' => 'required',
            'discount' => 'required',
            'discount_type' => 'required|in:percentage,fixed_amount',
            'start_date' => 'required',
            'expiry_date' => 'required',
            'minimum_order_amount' => 'required',
        ]);
        $coupon = Coupon::find($id);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images', $filename);
            $coupon->image = $filename;
        }

        $coupon->update([
            'name'      => $request->input('name'),
            'coupon_code'  => $request->input('coupon_code'),
            'coupon_description'  => $request->input('coupon_description'),
            'discount'  => $request->input('discount'),
            'discount_type'  => $request->input('discount_type'),
            'start_date'  => $request->input('start_date'),
            'expiry_date'  => $request->input('expiry_date'),
            'minimum_order_amount'  => $request->input('minimum_order_amount'),
        ]);

        session()->flash('success', 'Coupon Updated  successfully!');
        return redirect()->route('coupon');
    }
    public function couponDestroy($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        session()->flash('danger', 'Coupon Delete successfully!');
        return redirect()->back();
    }
}
