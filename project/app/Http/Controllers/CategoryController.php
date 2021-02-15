<?php

namespace App\Http\Controllers;
use App\Category;
use Carbon\Carbon;
use Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function AddCategory(){
        
        return view('backend.category.add_category');
    }

    function PostCategory(Request $request){
        $request->validate([
            'category_name' => ['required', 'unique:categories'],
            'category_image' => ['image']
        ]);
        
        if($request->hasFile('category_image')){
            $file = $request->file('category_image');
            $ext = Str::lower(Str::random(5)).'.'.$file->getClientOriginalExtension();
            $image = Image::make($file)->resize(600, 370)->save(public_path('thumbnail/category/'.$ext), 50);
        }

        Category::insert([
            'category_name' => $request->category_name,
            'category_image' => $ext,
            'created_at' => Carbon::now()
        ]);

        return back()->with('success', 'Category Inserted Successfully');

    }

    function ViewCategory(){
        $categories = Category::paginate();
        return view('backend.category.view_category', compact('categories'));
    }

    function EditCategory($id){
        $category = Category::findOrFail($id);
        return view('backend.category.edit_category', compact('category'));
    }

    function UpdateCategory(Request $request){

        if($request->hasFile('category_image')){
            $image = $request->file('category_image');
            $id = $request->category_id;
            $old_image = Category::findOrFail($id)->category_image;
            
            if(file_exists(public_path('thumbnail/category/'.$old_image))){
                unlink(public_path('thumbnail/category/'.$old_image));
            }

            $ext = Str::lower(Str::random(5)). '.' .$image->getClientOriginalExtension();
            Image::make($image)->resize(600,370)->save(public_path('thumbnail/category/'.$ext), 50);
            
            Category::findOrFail($id)->update([
                'category_name' => $request->category_name,
                'category_image' => $ext,
                'updated_at' => Carbon::now()
            ]);
        }
        else {
            $id = $request->category_id;
            Category::findOrFail($id)->update([
                'category_name' => $request->category_name,
                'category_image' => $request->category_image,
                'updated_at' => Carbon::now()
            ]);
        }

        return back()->with('success', 'Category Updated Successfully');

    }

    function DeleteCategory($id){
        Category::findOrFail($id)->delete();
        return back()->with('success', 'Category Deleted Successfully');
    }

    function TrashedCategory(){
        $categories = Category::onlyTrashed()->paginate();
        return view('backend.category.trashed_category', compact('categories'));
    }

    function RestoreCategory($id){
        Category::withTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'Category Restored');
    }

    function PermanentCategory($id){
        $image = Category::withTrashed()->findOrFail($id)->category_image;
        if(file_exists(public_path('thumbnail/category/'.$image))){

            unlink(public_path('thumbnail/category/'.$image));
            Category::withTrashed()->findOrFail($id)->forceDelete();
        }
        return back()->with('success', 'Category Permanently Deleted');
    }
}
