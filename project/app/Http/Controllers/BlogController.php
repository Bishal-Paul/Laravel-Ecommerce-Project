<?php

namespace App\Http\Controllers;
use App\BlogCategory;
use App\Blog;
use App\BlogComment;
use Image;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    function AddBlogCategory(){

        return view('backend.blog.add_blog_category');
    }

    function PostBlogCategory(Request $request){
        
        BlogCategory::insert([
            'name' => $request->blog_category,
            'created_at' => Carbon::now()
        ]);
        return back()->with('success', 'Category for Blog Created Successfully');
    }

    function ViewBlogCategory(){
        $blogcategory = BlogCategory::paginate(10);
        return view('backend.blog.view_blog_category', compact('blogcategory'));
    }
    function DeleteBlogCategory($id){
        BlogCategory::findOrFail($id)->delete();
        return back()->with('success', 'Category Deleted');
    }

    // Blog Part

    function AddBlog(){
        $blogcat = BlogCategory::orderBy('name', 'asc')->get();
        return view('backend.blog.add_blog', compact('blogcat'));
    }

    function PostBlog(Request $request){
        $user_id = Auth::id();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = Str::lower(Str::random(5)).'.'.$file->getClientOriginalExtension();
            Image::make($file)->resize(750,380)->save(public_path('thumbnail/category/'.$ext), 50);
        }
        Blog::insert([
            'title' => $request->title,
            'slug' => $request->slug,
            'user_id' => $user_id,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'image' => $ext,
            'created_at' => Carbon::now()
        ]);
        return back()->with('success', 'Blog Post Created.');
    }

    function ViewBlog(){
        $blog = Blog::with('category')->paginate(10);
        return view('backend.blog.view_blog', compact('blog'));
    }

    function EditBlog($id){
        $blog = Blog::with('category')->where('id', $id)->first();
        $blogcat = BlogCategory::orderBy('name', 'asc')->get();
        return view('backend.blog.edit_blog', compact('blog', 'blogcat'));
    }

    function UpdateBlog(Request $request){
       $id = $request->blog_id;
       
       if($request->hasFile('image')){
        $user_id = Auth::id();
        $id = $request->blog_id;
        $image = $request->file('image');

        $old_image = Blog::findOrFail($id)->image;
    
        if(file_exists(public_path('thumbnail/category/'.$old_image))){
            unlink(public_path('thumbnail/category/'.$old_image));
        }

        $ext1 = Str::lower(Str::random(5)).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(750,380)->save(public_path('thumbnail/category/'.$ext1), 50);

        Blog::findOrFail($id)->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'image' => $ext1,
            'updated_at' => Carbon::now()
        ]);
    }
    else {
        Blog::findOrFail($id)->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'updated_at' => Carbon::now()
        ]);
    }

    return redirect(route('EditBlog', $id))->with('message', 'Blog Updated Successfully');
    }

    function DeleteBlog($id){
        Blog::findOrFail($id)->delete();
        return back()->with('success', 'Blog Trashed.');
    }

    function TrashedBlog(){
        $blog = Blog::onlyTrashed()->with('category')->paginate();
        return view('backend.blog.trashed_blog', compact('blog'));
    }

    function RestoreBlog($id){
        Blog::withTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'Blog Post Restored');
    }

    function ForseDelete($id){
        $image = Blog::onlyTrashed()->findOrFail($id)->image;
        
        if(file_exists(public_path('thumbnail/category/'.$image))){

            unlink(public_path('thumbnail/category/'.$image));
            Blog::withTrashed()->findOrFail($id)->forceDelete();
        }

        return back()->with('success', 'Product Permanently Deleted');
    }

    // Blog Frontend

    function Blog(){
        $category = BlogCategory::latest()->take(4)->get();
        $recent = Blog::latest()->take(3)->get();
        $blogs = Blog::simplepaginate(6);
        return view('frontend.blog', compact('blogs', 'category', 'recent'));
    }

    function SingleBlog($id){
        $category = BlogCategory::latest()->take(5)->get();
        $blog = Blog::where('id', $id)->first();
        $recent = Blog::latest()->take(3)->get();
        $comment = BlogComment::where('blog_id', $blog->id)->get();
        return view('frontend.single_blog', compact('blog', 'recent', 'category', 'comment'));
    }

    function SearchBlog(Request $request){
        $id = $request->id;
        $blog = Blog::where('id', $id)->first();
        $query = $request->search_blog;
        $category = BlogCategory::latest()->take(5)->get();
        $recent = Blog::latest()->take(3)->get();
        $searchblog = Blog::where('title', 'like', "%{$query}%")->get();
        $comment = BlogComment::where('blog_id', $id)->get();

        return view('frontend.blog', compact('query', 'searchblog', 'category', 'recent', 'blog', 'comment'));
    }

    function BlogComment(Request $request){

        if (BlogComment::where('blog_id', $request->blog_id)->where('name', $request->name)->exists()) {
           return back();
        }
        else{
            BlogComment::insert([
                'blog_id' => $request->blog_id,
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
                'created_at' => Carbon::now()
            ]);
        }
        
        return back();
    }

    function SingleCat($id){
        $blogcat = Blog::where('category_id', $id)->get();
        $category = BlogCategory::latest()->take(5)->get();
        $recent = Blog::latest()->take(3)->get();
        return view('frontend.blog_category', compact('blogcat', 'category', 'recent'));
    }
}
