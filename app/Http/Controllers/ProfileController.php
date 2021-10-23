<?php

namespace App\Http\Controllers;

use App\Product;
use App\Profile;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($id){
        $user=User::where('id',$id)->firstOrFail();
        $products=Product::where('user_id',$id)->get();
        /*$follows= (auth()->user()) ? auth()->user()->following->contains($id):false;
        dd($user->profile->followers);*/
        if(auth()->check()) {
            if ($user->profile->followers->contains(auth()->user()->id)) {
                $follows = true;
            } else {
                $follows = false;
            }
            return view('profile')->with([
                'user' => $user,
                'products'=>$products,
                'follows'=>$follows,
            ]);
        }
        else{
            return view('profile')->with([
                'user' => $user,
                'products'=>$products,

            ]);
        }



}
}
