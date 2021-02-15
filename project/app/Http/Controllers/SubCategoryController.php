<?php

namespace App\Http\Controllers;
use App\Category;
use App\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    function AddSubCategory(){
        $category = Category::orderBy('category_name', 'asc')->get();
        return view('backend.subcategory.add_subcategory', compact('category'));
    }

    function PostSubCategory(Request $request){
        $request->validate([
            'category_id' => ['required'],
            'subcategory_name' => ['required']
        ]);
        
        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'created_at' => Carbon::now()
        ]);

        return back()->with('success', 'Sub Category Created Successfully');
    }

    function ViewSubCategory(){
        $subcategories = SubCategory::with('category')->paginate();
        return view('backend.subcategory.view_subcategory', compact('subcategories'));
    }

    function EditSubCategory($id){
        $subcategory = SubCategory::findOrFail($id);
        $category = Category::orderBy('category_name', 'asc')->get();
        return view('backend.subcategory.edit_subcategory', compact('subcategory', 'category'));
    }

    function UpdateSubCategory(Request $request){
        SubCategory::findOrFail($request->subcategory_id)->update([
            'subcategory_name' => $request->subcategory_name,
            'category_id' => $request->category_id,
            'updated_at' => Carbon::now()
        ]);

        return back()->with('success', 'Sub Category Updated');
    }

    function DeleteSubCategory($id){
        SubCategory::findOrFail($id)->delete();
        return back()->with('success', 'Sub Category Deleted Successfully');
    }

    function TrashedSubCategory(){
        $subcategory = SubCategory::onlyTrashed()->paginate();
        return view('backend.subcategory.trashed_subcategory', compact('subcategory'));
    }

    function RestoreSubCategory($id){
        SubCategory::withTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'Sub Category Restored');
    }

    function PermanentSubCategory($id){
        SubCategory::withTrashed()->findOrFail($id)->forceDelete();
        return back()->with('success', 'SubCategory Permanently Deleted');
    }
}
