<?php

namespace App\Http\Controllers;
use App\Category;
use App\FlashSale;
use App\SubCategory;
use App\Product;
use App\Review;
use App\ProductImage;
use Carbon\Carbon;
use Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    function AddProduct(){
        $category = Category::orderBy('category_name', 'asc')->get();
        return view('backend.product.add_product', compact('category'));
    }

    function PostProduct(Request $request){

        

        $request->validate([
            'product_name' => ['required'],
            'slug' => ['required', 'unique:products'],
            'product_price' => ['required'],
            'product_summary' => ['required'],
            'product_thumbnail' => ['required', 'image']
        ]);

        if($request->hasFile('product_thumbnail')){
            $file = $request->file('product_thumbnail');
            $ext = $request->slug .'.'. $file->getClientOriginalExtension();
            $image = Image::make($file)->resize(550, 750)->save(public_path('thumbnail/product/'.$ext), 50);
        }

        if(isset($request->flash_sale)){
            $product_id = Product::insertGetId([

                'product_name' => $request->product_name,
                'slug' => $request->slug,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'product_price' => $request->product_price,
                'discount_price' => $request->discount_price,
                'product_quantity' => $request->product_quantity,
                'product_summary' => $request->product_summary,
                'product_description' => $request->product_description,
                'product_size' => $request->product_size,
                'product_color' => $request->product_color,
                'product_thumbnail' => $ext,
                'product_status' => 2,
                'created_at' => Carbon::now()
            ]);
        }
        else {
            $product_id = Product::insertGetId([

                'product_name' => $request->product_name,
                'slug' => $request->slug,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'product_price' => $request->product_price,
                'discount_price' => $request->discount_price,
                'product_quantity' => $request->product_quantity,
                'product_summary' => $request->product_summary,
                'product_description' => $request->product_description,
                'product_size' => $request->product_size,
                'product_color' => $request->product_color,
                'product_thumbnail' => $ext,
                'created_at' => Carbon::now()
            ]);
        }

        

        if($request->hasFile('product_image')){
            $file = $request->file('product_image');

            foreach($file as $item){
                $ext1 = $request->slug.'-'.Str::lower(Str::random(3)).'.'. $item->getClientOriginalExtension();
                $item = Image::make($item)->resize(550, 750)->save(public_path('thumbnail/product/gallery/'.$ext1), 50);

                ProductImage::insert([
                    'product_id' => $product_id,
                    'product_image' => $ext1,
                    'created_at' => Carbon::now()
                ]);
            }

        }
        
        return back()->with('success', 'Product Inserted Successfully');
    }

    function ViewProduct(){
        $product = Product::with('category')->paginate();
        return view('backend.product.view_product', compact('product'));
    }

    function GetSubCategory($id){
        $subcat = SubCategory::where('category_id', $id)->orderBy('subcategory_name', 'asc')->get();
        return response()->json($subcat);
    }

    function EditProduct($slug){
        $product = Product::with('subcategory')->with('category')->where('slug', $slug)->first();
        $category = Category::orderBy('category_name', 'asc')->get();
        return view('backend.product.edit_product', compact('product', 'category'));
    }

    function UpdateProduct(Request $request){
        $slug = $request->slug;

        if($request->hasFile('product_thumbnail')){

            $slug = $request->slug;
            $image = $request->file('product_thumbnail');

            $old_image = Product::findOrFail($request->product_id)->product_thumbnail;
        
            if(file_exists(public_path('thumbnail/product/'.$old_image))){
                unlink(public_path('thumbnail/product/'.$old_image));
            }

            $ext = $request->slug. '.' .$image->getClientOriginalExtension();
            Image::make($image)->resize(550,750)->save(public_path('thumbnail/product/'.$ext), 50);

            Product::findOrFail($request->product_id)->update([
                'product_name' => $request->product_name,
                'slug' => $slug,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'product_price' => $request->product_price,
                'discount_price' => $request->discount_price,
                'product_quantity' => $request->product_quantity,
                'product_summary' => $request->product_summary,
                'product_description' => $request->product_description,
                'product_size' => $request->product_size,
                'product_color' => $request->product_color,
                'product_thumbnail' => $ext,
                'updated_at' => Carbon::now()
            ]);
        }
        else {
            Product::findOrFail($request->product_id)->update([
                'product_name' => $request->product_name,
                'slug' => $slug,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'product_price' => $request->product_price,
                'discount_price' => $request->discount_price,
                'product_quantity' => $request->product_quantity,
                'product_summary' => $request->product_summary,
                'product_description' => $request->product_description,
                'product_size' => $request->product_size,
                'product_color' => $request->product_color,
                'updated_at' => Carbon::now()
            ]);
        }

        return redirect(route('EditProduct', $slug))->with('message', 'Product Updated Successfully');
    }

    function DeleteProduct($id){
        Product::findOrFail($id)->delete();
        return back()->with('success', 'Product Trashed');
    }

    function TrashedProduct(){
        $product = Product::onlyTrashed()->with('category')->paginate();
        return view('backend.product.trashed_product', compact('product'));
    }

    function RestoreProduct($id){
        Product::withTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'Product Restored');
    }

    function PermanentDeleteProduct($id){

        $image = Product::onlyTrashed()->findOrFail($id)->product_thumbnail;
        
        if(file_exists(public_path('thumbnail/product/'.$image))){

            unlink(public_path('thumbnail/product/'.$image));
            Product::withTrashed()->findOrFail($id)->forceDelete();
        }

        return back()->with('success', 'Product Permanently Deleted');
    }

    function SingleProduct($id){
        
        $product = Product::where('id', $id)->first();
        $rating = Review::where('product_id', $product->id)->get();
        $count = Review::where('product_id', $product->id)->count();
        $sum = Review::where('product_id', $product->id)->sum('rating');
        $pro = Product::with('category')->orderBy('product_name', 'asc')->get();
        $related = Product::where('category_id', $product->category_id)->get();
        return view('frontend.single_product', compact('product', 'related', 'pro', 'rating', 'count', 'sum'));
    }
}
