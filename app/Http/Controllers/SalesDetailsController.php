<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesDetails;
use App\Models\SalesMaster;
use App\Models\Product;

class SalesDetailsController extends Controller
{
    public function salesdetail()
    {
        $salesdetails = SalesDetails::with(['salesMaster', 'product'])->get();
        return view('salesdetail.view_salesdetail', compact('salesdetails'));
    }
    
    public function salesdetailCreate()
    {
        $salesmasters = SalesMaster::pluck('id', 'id');
        $products = Product::pluck('name', 'id');
        return view('salesdetail.create_salesdetail', compact('salesmasters', 'products'));
    }
    public function salesdetailInsert(Request $request)
    {
        $request->validate([
            'sales_master_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
            'amount' => 'required',
            'discount' => 'required',
            'total_amount' => 'required',
        ]);

        $salesdetails = SalesDetails::create([
            'sales_master_id'  => $request->input('sales_master_id'),
            'product_id'       => $request->input('product_id'),
            'quantity'  => $request->input('quantity'),
            'amount'  => $request->input('amount'),
            'discount'  => $request->input('discount'),
            'total_amount'  => $request->input('total_amount'),
        ]);

        session()->flash('success', 'Sales Detail added successfully!');
        return redirect()->route('salesdetail');
    }
    public function salesdetailEdit($id)
    {
        $salesmasters = SalesMaster::pluck('id', 'id');
        $products = Product::pluck('name', 'id');
        $salesdetail = SalesDetails::find($id);
        return view('salesdetail.create_salesdetail', compact('salesdetail', 'salesmasters', 'products'));
    }
    public function salesdetailUpdate(Request $request, $id)
    {
        $request->validate([
            'sales_master_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
            'amount' => 'required',
            'discount' => 'required',
            'total_amount' => 'required',
        ]);
        $salesdetails = SalesDetails::find($id);

        $salesdetails->update([
            'sales_master_id'  => $request->input('sales_master_id'),
            'product_id'       => $request->input('product_id'),
            'quantity'  => $request->input('quantity'),
            'amount'  => $request->input('amount'),
            'discount'  => $request->input('discount'),
            'total_amount'  => $request->input('total_amount'),
        ]);

        session()->flash('success', 'Sales Detail updated successfully!');
        return redirect()->route('salesdetail');
    }
    public function salesdetailDestroy($id)
    {
        $salesdetails = SalesDetails::find($id);
        $salesdetails->delete();
        session()->flash('danger', 'Sales Detail Delete successfully!');
        return redirect()->back();
    }
}
