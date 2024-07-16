<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public function subcategory(){
        $subcategorys = SubCategory::with('category')->get();
        return view('subcategory.view_sub_category',compact('subcategorys'));
    }

    public function createsubCategory(){
        $categorys = Category::all();
        return view('subcategory.create_sub_category',compact('categorys'));
    }
    public function storesubCategory(Request $request) {
        $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required',
        ]);

        $filename = '';

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images', $filename);
        }
        
        $subcategory = SubCategory::create([
            'category_id'      => $request->input('category_id'),
            'subcategory_name' => $request->input('subcategory_name'),
            'image'            => $filename,

        ]);

        session()->flash('success', 'Subcategory added successfully!');
        return redirect()->route('subcategory');
    }
    public function Editsubcategory($id)
    {
        $subcategory = SubCategory::find($id);
        $categorys = Category::all();
        return view('subcategory.create_sub_category', compact('subcategory','categorys'));
    }

    public function Updatesubcategory(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required',
        ]);
    
        $subcategory = SubCategory::find($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images', $filename);
            $subcategory->image = $filename;
        }
        $subcategory->update([
            'category_id' => $request->input('category_id'),
            'subcategory_name' => $request->input('subcategory_name'),
        ]);
        session()->flash('success', 'Subcategory Updated successfully!');
        return redirect()->route('subcategory');
    }
    public function Destroysubcategory($id)
    {
        $subcategory = SubCategory::find($id);
        $subcategory->delete();
        session()->flash('danger', 'Subcategory Delete successfully!');
        return redirect()->back();
    }
}
