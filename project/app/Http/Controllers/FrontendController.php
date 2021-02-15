<?php

namespace App\Http\Controllers;

use App\Bannar;
use App\Category;
use App\FlashSale;
use App\Product;
use App\Review;
use App\Newsletter;
use App\ProductImage;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    
    function Frontend(){
        $category = Category::with('product')->latest()->take(6)->get();
        $bannar = Bannar::latest()->get();
        $flashsale = Product::where('product_status', 2)->latest()->get();
        $product = Product::latest()->get();
        return view('frontend.frontend', compact('category', 'product', 'flashsale', 'bannar'));
    }

    function Shop(){
        $category = Category::orderBy('category_name', 'asc')->get();
        $recent = Product::latest()->take(5)->get();
        $product = Product::with('category')->orderBy('product_name', 'asc')->simplePaginate(15);
        return view('frontend.shop', compact('category', 'product', 'recent'));
    }

    function ShopListView(){
        $category = Category::orderBy('category_name', 'asc')->get(); 
        $recent = Product::latest()->take(5)->get();
        $product = Product::with('category')->orderBy('product_name', 'asc')->simplePaginate(15);
        //$product = Product::where('category_id', $product->category->id)->get();
        return view('frontend.shop_list', compact('category', 'recent', 'product'));
    }

    function SingleShop($cat_id){
        $category = Category::orderBy('category_name', 'asc')->get(); 
        $recent = Product::latest()->take(5)->get();

        $product = Product::where('category_id', $cat_id)->get();        
        return view('frontend.single_shop', compact('category', 'recent', 'product'));
    }

    function SingleSubShop($id){
        $product = Product::where('subcategory_id', $id)->get();  
        $category = Category::orderBy('category_name', 'asc')->get(); 
        $recent = Product::latest()->take(5)->get();      
        return view('frontend.single_sub_shop', compact('product', 'category', 'recent'));
    }

    function PostReview(Request $request){
        
        $user_id = Auth::id();
        $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'rating' => ['required'],
            'message' => ['required'],
        ]);

        $exists = Review::where('user_id', $user_id)->where('product_id', $request->product_id)->exists();
        if ($exists) {
            return back()->with('exists', 'You Allready Reviewed this Product.');
        }
        else {
            Review::insert([
                'user_id' => $user_id,
                'product_id' => $request->product_id,
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
                'rating' => $request->rating,
                'created_at' => Carbon::now()
            ]);
        }

        return back();
    }

    // Product Search by price

    function ProductSearch(Request $request){
        $category = Category::orderBy('category_name', 'asc')->get(); 
        $recent = Product::latest()->take(5)->get();
        $product = Product::with('category')->orderBy('product_name', 'asc')->get();
        $search = Product::whereBetween('product_price', [$request->start, $request->end])->get();
        return view('frontend.shop', compact('search', 'category', 'recent', 'product'));
    }

    // Product Search 

    function Search(Request $request){
        $category = Category::orderBy('category_name', 'asc')->get(); 
        $recent = Product::latest()->take(5)->get();
        $query = $request->search;
        $searchproduct = Product::where('product_name', 'like', "%{$query}%")->get();

        return view('frontend.search_result', compact('searchproduct', 'query', 'category', 'recent'));
    }

    // Newsletter

    function Newsletter(Request $request){
        $request->validate([
            'email' => ['unique:newsletters'],
        ]);
        Newsletter::insert([
            'email' => $request->email,
            'created_at' => Carbon::now()
        ]);
        return back();
    }

    function ViewNews(){
        $news = Newsletter::paginate();
        return view('backend.view_newsletter', compact('news'));
    }

    function DeleteNews($id){
        Newsletter::findOrFail($id)->delete();
        return back();
    }

}
