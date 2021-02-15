<?php

namespace App\Http\Controllers;
use App\Billings;
use App\Shipping;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    function AllOrders(){
        $billings = Billings::with('product')->latest()->paginate(10);
        return view('backend.admin.all_orders', compact('billings'));
    }

    function FullOrder($id){
        
        $billings = Billings::with('shipping')->findOrFail($id);
        
        return view('backend.admin.view_order_details', compact('billings'));
    }

    function OrderStatus(Request $request){
        $id = $request->id;
        Billings::where('id', $id)->update([
            'order_status' => $request->order_status,
            'updated_at' => Carbon::now()
        ]);

        return back()->with('order', 'Order Status Updated');
    }

    function Processing(){
        $processing = Billings::where('order_status', 1)->get();
        return view('backend.admin.all_orders', compact('processing'));
    }

    function Delivared(){
        $delivared = Billings::where('order_status', 2)->get();
        return view('backend.admin.all_orders', compact('delivared'));
    }

    function Returned(){
        $returned = Billings::where('order_status', 3)->get();
        return view('backend.admin.all_orders', compact('returned'));
    }

    function Canceled(){
        $canceled = Billings::where('order_status', 4)->get();
        return view('backend.admin.all_orders', compact('canceled'));
    }
}
