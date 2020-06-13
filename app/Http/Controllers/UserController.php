<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function index(){
        return view('homepage');
    }

    public function uploadAcatar(Request $request){
        if($request->hasfile('image')){
            $fileName = $request->image->getClientOriginalName();

            if(auth()->user()->avatar){
                Storage::delete("/public/images/" . (auth()->user()->avatar));
            }

            $request->image->storeAs('images', $fileName,'public');
            auth()->user()->update(['avatar'=> $fileName]);

            $request->session()->flash('message1', "image uploaded");

            return redirect()->back();
        }

        $request->session()->flash('message2', "Please, Upload an image.");
        return redirect()->back();
    }
}
