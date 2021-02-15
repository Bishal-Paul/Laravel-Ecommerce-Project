<?php

namespace App\Http\Controllers;
use App\Coupon;
use Carbon\Carbon;
use App\Cart;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    function AddCoupon(){

        return view('backend.coupon.add_coupon');
    }

    function PostCoupon(Request $request){

        Coupon::insert([
            'coupon_name' => $request->coupon_name,
            'coupon_code' => $request->coupon_code,
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now()
        ]);

        return back()->with('success', 'Coupon Created Successfully');
    }

    function ViewCoupon(){
        $coupon = Coupon::paginate();
        return view('backend.coupon.view_coupon', compact('coupon'));
    }

    function DeleteCoupon($id){
        Coupon::findOrFail($id)->delete();
        return back()->with('success', 'Coupon Deleted');
    }

    function CartCoupon(Request $request){
        $coupon = $request->coupon;

        if($coupon == ""){
            $user_ip = $_SERVER['REMOTE_ADDR'];
            $cart = Cart::with('product')->where('user_ip', $user_ip)->get();
            $subtotal = 0;
            $discount = 0;
            $after_discount = $subtotal * ($discount / 100);
            session(['after_discount' => $after_discount]);
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

        else {
            if(Coupon::where('coupon_code', $coupon)->exists()){
                if (Carbon::now()->format('Y-m-d') <= Coupon::where('coupon_code', $coupon)->first()->coupon_validity) {
                    $user_ip = $_SERVER['REMOTE_ADDR'];
                    $cart = Cart::with('product')->where('user_ip', $user_ip)->get();
                    $subtotal = 0;
                    $discount = Coupon::where('coupon_code', $coupon)->first()->coupon_discount;
                    
                    foreach($cart as $val){
                        if ($val->product->discount_price == NULL) {
                            $subtotal += $val->product->product_price * $val->quantity;
                        }
                        else {
                            $subtotal += $val->product->discount_price * $val->quantity;
                        }
                    }
                    $after_discount = $subtotal * ($discount / 100);
                    session(['after_discount' => $after_discount]);
                    return view('frontend.cart', compact('cart', 'subtotal', 'discount', 'after_discount'));
                }
                else {
                    return back()->with('success', 'This Coupon is Expired');
                }
            }
            else {
                return back()->with('success', 'Invaild Coupon Code');
            }
        }
    }
}
