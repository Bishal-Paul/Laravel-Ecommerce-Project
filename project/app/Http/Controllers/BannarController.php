<?php

namespace App\Http\Controllers;
use App\Bannar;
use Carbon\Carbon;
use Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BannarController extends Controller
{
    function AddBannar(){

        return view('backend.bannar.add_bannar');
    }

    function PostBannar(Request $request){

        $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'image' => ['required', 'image']
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = Str::lower(Str::random(5)).'.'.$file->getClientOriginalExtension();
            $image = Image::make($file)->resize(1903, 568)->save(public_path('thumbnail/bannar/'.$ext), 50);
        }

        Bannar::insert([
            'offer' => $request->offer,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $ext,
            'created_at' => Carbon::now()
        ]);

        return back()->with('success', 'Bannar Uploaded Successfully');
    }

    function ViewBannar(){
        $bannar = Bannar::paginate(5);
        return view('backend.bannar.view_bannar', compact('bannar'));
    }

    function DeleteBannar($id){
        Bannar::findOrFail($id)->delete();
        return back()->with('success', 'Bannar Deleted');
    }
}
