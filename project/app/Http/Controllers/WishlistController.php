<?php

namespace App\Http\Controllers;
use App\Product;
use Carbon\Carbon;
use App\Wishlist;
use App\Compare;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    function Wishlist(){
        $user_ip = $_SERVER['REMOTE_ADDR'];

        $wishlist = Wishlist::with('product')->where('user_ip', $user_ip)->get();
        return view('frontend.wishlist', compact('wishlist'));
    }

    function AddWishlist($id){
        $user_ip = $_SERVER['REMOTE_ADDR'];
        if(Wishlist::where('product_id', $id)->where('user_ip', $user_ip)->exists()){
            return back();
        }
        else {
            Wishlist::insert([
                'product_id' => $id,
                'user_ip' => $user_ip,
                'created_at' => Carbon::now() 
            ]);
        }
        return back();
    }

    function DeleteWishlist($id){

        $user_ip = $_SERVER['REMOTE_ADDR'];

        Wishlist::where('user_ip', $user_ip)->where('id', $id)->delete();
        return back();
    } 

    // Compare 

    function Compare(){
        $user_ip = $_SERVER['REMOTE_ADDR'];

        $compare = Compare::with('product')->where('user_ip', $user_ip)->get();
        return view('frontend.compare', compact('compare'));
    }

    function AddToCompare($id){
        $user_ip = $_SERVER['REMOTE_ADDR'];
        if(Compare::where('product_id', $id)->where('user_ip', $user_ip)->exists()){
            return back();
        }
        else {
            Compare::insert([
                'product_id' => $id,
                'user_ip' => $user_ip,
                'created_at' => Carbon::now() 
            ]);
        }
        return back();
    }

    function DeleteCompare($id){
        $user_ip = $_SERVER['REMOTE_ADDR'];

        Compare::where('user_ip', $user_ip)->where('id', $id)->delete();
        return back();
    }
}
