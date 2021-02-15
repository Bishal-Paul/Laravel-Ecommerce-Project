<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OrderShipped;
use App\Cart;
use App\Division;
use App\District;
use App\Upazila;
use App\Product;
use App\Union;
use App\Shipping;
use App\Billings;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function Checkout(Request $request){

        $division = Division::orderBy('bn_name', 'asc')->get();

        $user_ip = $_SERVER['REMOTE_ADDR'];
        $cart = Cart::with('product')->where('user_ip', $user_ip)->get();
        $subtotal = 0;
        $discount = 0;
        $after_discount = $request->session()->get('after_discount');
        foreach($cart as $val){
            if ($val->product->discount_price == NULL) {
                $subtotal += $val->product->product_price * $val->quantity;
            }
            else {
                $subtotal += $val->product->discount_price * $val->quantity;
            }
        }
        $total = $subtotal - $after_discount;
        session(['total' => $total]);
        return view('frontend.checkout', compact('cart', 'subtotal', 'discount', 'after_discount', 'division', 'total'));
    }

    function GetDistrict($id){
        $district = District::where('division_id', $id)->orderBy('bn_name', 'asc')->get();
        return response()->json($district);
    }

    function GetUpazila($id){
        $upazila = Upazila::where('district_id', $id)->orderBy('bn_name', 'asc')->get();
        return response()->json($upazila);
    }

    function GetUnion($id){
        $union = Union::where('upazilla_id', $id)->orderBy('bn_name', 'asc')->get();
        return response()->json($union);
    }

    function FinalCheckout(Request $request){

        if ($request->payment == !NULL) {
            $user_id = Auth::id();
            $total = $request->session()->get('total');
            $user_ip = $_SERVER['REMOTE_ADDR'];
            $cart = Cart::with('product')->where('user_ip', $user_ip)->get();

            $shipping_id = Shipping::insertGetId([
                'user_id' => $user_id,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'division' => $request->division,
                'district' => $request->district,
                'upazila' => $request->upazila,
                'union' => $request->union,
                'address' => $request->address,
                'post_code' => $request->post_code,
                'message' => $request->message,
                'payment_type' => $request->payment,
                'created_at' => Carbon::now()
            ]);

            foreach($cart as $item){
                Billings::insert([
                    'shipping_id' => $shipping_id,
                    'user_id' => $user_id,
                    'product_id' => $item->product_id,
                    'product_price' => $item->product->product_price,
                    'product_quantity' => $item->quantity,
                    'grand_total' => $total,
                    'created_at' => Carbon::now()
                ]);
                Product::findOrFail($item->product_id)->decrement('product_quantity', $item->quantity);

                $item->delete();
            }

            if ($request->payment == "card") {
                return "Card";
            }
            elseif ($request->payment == "cash") {
                Shipping::findOrFail($shipping_id)->update([
                    'payment_status' => 2
                ]);
                
                $billings = Billings::with('product')->where('shipping_id', $shipping_id)->get();
                Mail::to(Auth::user()->email)->send(new OrderShipped($billings));
                return view('frontend.mail_success');
            }
            else{
                return back()->with('payment', 'You Changed Payment Method Value!!');
            }
        }
        else{
            return back()->with('payment', 'Please Select a Payment Method!!');
        }
    }
}
