<?php

namespace App\Http\Controllers;
use App\Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    function Cart(){
        $user_ip = $_SERVER['REMOTE_ADDR'];
        $cart = Cart::with('product')->where('user_ip', $user_ip)->get();
        $subtotal = 0;
        $discount = 0;
        $after_discount = 0;
        foreach($cart as $val){
            if ($val->product->discount_price == NULL) {
                $subtotal += $val->product->product_price * $val->quantity;
            }
            else {
                $subtotal += $val->product->discount_price * $val->quantity;
            }
        }
        return view('frontend.cart', compact('cart', 'subtotal', 'discount', 'after_discount'));
    }

    function SingleCart($id){
        $user_ip = $_SERVER['REMOTE_ADDR'];

        if(Cart::where('product_id', $id)->where('user_ip', $user_ip)->exists()){
            Cart::where('product_id', $id)->where('user_ip', $user_ip)->increment('quantity');
        }
        else{
            Cart::insert([
                'product_id' => $id,
                'user_ip' => $user_ip,
                'created_at' => Carbon::now()
            ]);    
        }
        
        return back();
    }

    function SingleCartDelete($id){
        $user_ip = $_SERVER['REMOTE_ADDR'];
        Cart::where('user_ip', $user_ip)->where('id', $id)->delete();
        return back();
    }

    function MultipleCart(Request $request){

        $user_ip = $_SERVER['REMOTE_ADDR'];

        if(Cart::where('product_id', $request->product_id)->where('user_ip', $user_ip)->exists()){
            Cart::where('product_id', $request->product_id)->where('user_ip', $user_ip)->increment('quantity', $request->quantity);
        }
        else{
            Cart::insert([
                'product_id' => $request->product_id,
                'user_ip' => $user_ip,
                'quantity' => $request->quantity,
                'created_at' => Carbon::now()
            ]);    
        }

        return back();
    }
}
