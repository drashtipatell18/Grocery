<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category()
    {
        $categorys = Category::all();
        return view('category.view_category',compact('categorys'));
    }
    public function createCategory()
    {
        return view('category.create_category');
    }
      
    public function storeCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $filename = '';

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images', $filename);
        }

        $category  = Category::create([
            'category_name' => $request->input('category_name'),
            'image'         => $filename,
        ]);
        return redirect()->route('categoryinfo')->with('success', 'Category inserted successfully.');
    }
    
    
    public function categoryEdit($id)
    {
        $category = Category::find($id);
        return view('category.create_category', compact('category'));
    }

    public function categoryUpdate(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);
    
        $category = Category::find($id);
       
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images', $filename);
            $category->image = $filename;
        }

        // Update category name
        $category->update([
            'category_name' => $request->input('category_name')
        ]);
        return redirect()->route('categoryinfo')->with('success', 'Category updated successfully.');
    }
    
    public function categoryDestroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('categoryinfo')->with('danger', 'Category delete successfully.');
    }
    
}
