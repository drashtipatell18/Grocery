<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesMaster;
use App\Models\Coupon;
use App\Models\User;
use App\Models\UserAddress;


class SalesMasterController extends Controller
{
    public function salesmaster(){
        $salesmasters = SalesMaster::with(['user', 'coupon', 'userAddress'])->get();
        return view('salesmaster.view_salesmaster', compact('salesmasters'));
    }
    public function salesmasterCreate(){
        $users = User::pluck('name', 'id');
        $coupons = Coupon::pluck('name', 'id');
        $useraddress = UserAddress::pluck('address', 'id');
        
        return view('salesmaster.create_salesmaster',compact('users','coupons','useraddress'));
    }
    public function salesmasterInsert(Request $request){
        $request->validate([
            'user_id' => 'required',
            'coupon_id' => 'required',
            'user_address_id' => 'required',
            'order_date' => 'required',
            'sub_total' => 'required',
            'total_amount' => 'required',
            'discount' => 'required',
        ]);

        $salesmaster = SalesMaster::create([
            'user_id'      => $request->input('user_id'),
            'coupon_id'  => $request->input('coupon_id'),
            'user_address_id'  => $request->input('user_address_id'),
            'order_date'  => $request->input('order_date'),
            'sub_total'  => $request->input('sub_total'),
            'total_amount'  => $request->input('total_amount'),
            'discount'  => $request->input('discount'),
        ]);

        session()->flash('success', 'Sales Master added successfully!');
        return redirect()->route('salesmaster');
    }
    public function salesmasterEdit($id){
        $salesmaster = SalesMaster::find($id);
        $users = User::pluck('name', 'id');
        $coupons = Coupon::pluck('name', 'id');
        $useraddress = UserAddress::pluck('address', 'id');
        return view('salesmaster.create_salesmaster',compact('useraddress','salesmaster','users','coupons'));
    }
    public function salesmasterUpdate(Request $request, $id){
        $request->validate([
            'user_id' => 'required',
            'coupon_id' => 'required',
            'user_address_id' => 'required',
            'order_date' => 'required',
            'sub_total' => 'required',
            'total_amount' => 'required',
            'discount' => 'required',
        ]);
        $salesmaster = SalesMaster::find($id);

        $salesmaster->update([
            'user_id'      => $request->input('user_id'),
            'coupon_id'  => $request->input('coupon_id'),
            'user_address_id'  => $request->input('user_address_id'),
            'order_date'  => $request->input('order_date'),
            'sub_total'  => $request->input('sub_total'),
            'total_amount'  => $request->input('total_amount'),
            'discount'  => $request->input('discount'),
        ]);

        session()->flash('success', 'Sales Master updated successfully!');
        return redirect()->route('salesmaster');
    }
    public function salesmasterDestroy($id){
        $salesmaster = SalesMaster::find($id);
        $salesmaster->delete();
        session()->flash('danger', 'Sales Master Delete successfully!');
        return redirect()->back();
    }
}
