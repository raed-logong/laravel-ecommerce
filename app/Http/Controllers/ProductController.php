<?php

namespace App\Http\Controllers;

use App\CategoryProduct;
use App\Notifications\UserPosted;
use App\Product;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create () {
        return view('products.create');

    }
    public function store(Request $request){


        $imagepath=$request->image->store('products/dummy','public');
        $user=auth()->user();
        $product=new Product();
        $product->user_id=$user->id;
        $product->name=$request->name;
        $product->slug=$request->slug;
        $product->details=$request->details;
        $product->price=$request->price*100;

        $product->description=$request->description;
        $product->featured=0;
        $product->quantity=$request->quantity;
        $product->image=$request->image->store('products/dummy','public');
        //$images[]=[];
        //$fileNameToStore = serialize($request->images);
        $finalpath="[";

        foreach ($request->images as $image){
            $d=$image->store('products/dummy','public');
            $s=str_replace("/","\/",$d);
            $finalpath=$finalpath.'"'.$s.'"'.",";

        }
        $finalpath=substr_replace($finalpath, "", -1);
        $finalpath=$finalpath."]";
        $product->images=$finalpath;
        date_default_timezone_set("Africa/Lagos");
        $d=date("Y-m-d H:i:s");
        $datetime = new DateTime( "now", new DateTimeZone( "Europe/Bucharest" ) );
        $d=$datetime->getTimestamp();


        //$d=substr_replace($d, "", -1);
        //$d=substr_replace($d, "", -1);
        //dd(date("Y-m-d h:i:sa"));
        //dd($d);
        $product->setCreatedAt($d);
        $product->setUpdatedAt($d);

        $product->save();

        CategoryProduct::create([
            'product_id' => $product->id,
            'category_id' => $request->categories,
        ]);

        $followers=$user->profile->followers;
        foreach ($followers as $follower){
            $follower->notify(new UserPosted($user,$product));
        }
        return back()->with('success_message', 'Product added successfully!');


    }
}
