<?php

namespace App\Http\Controllers;
use App\Contact;
use App\SiteInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    function ContactUs(){
        $info = SiteInfo::latest()->take(1)->first();
        return view('frontend.contact_us', compact('info'));
    }

    function PostContact(Request $request){

        $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'message' => ['required']
        ]);

        Contact::insert([
            'name' => $request->name,
            'subject' => $request->subject,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ]);
    }

    // Site Info

    function AddInfo(){

        return view('backend.information.add_info');
    }

    function PostInfo(Request $request){
        $request->validate([
            'email1' => ['required'],
            'number1' => ['required'],
            'road_no' => ['required'],
            'city' => ['required'],
            'country' => ['required'],
            'description' => ['required']
        ]);

        SiteInfo::insert([
            'email1' => $request->email1,
            'email2' => $request->email2,
            'number1' => $request->number1,
            'number2' => $request->number2,
            'number3' => $request->number3,
            'road_no' => $request->road_no,
            'city' => $request->city,
            'country' => $request->country,
            'description' => $request->description,
            'created_at' => Carbon::now()
        ]);

        return back()->with('success', 'Info Added Successfully');
    }

    function ViewInfo(){
        $info = SiteInfo::paginate();
        return view('backend.information.view_info', compact('info'));
    }

    function EditInfo($id){
        $info = SiteInfo::where('id', $id)->first();
        return view('backend.information.edit_info', compact('info'));
    }

    function UpdateInfo(Request $request){
        SiteInfo::where('id', $request->info_id)->update([
            'email1' => $request->email1,
            'email2' => $request->email2,
            'number1' => $request->number1,
            'number2' => $request->number2,
            'number3' => $request->number3,
            'road_no' => $request->road_no,
            'city' => $request->city,
            'country' => $request->country,
            'description' => $request->description,
            'updated_at' => Carbon::now()
        ]);
        return back()->with('success', 'Information Updated');
    }

    function DeleteInfo($id){
        SiteInfo::where('id', $id)->delete();
        return back()->with('success', 'Information Deleted');
    }

}
