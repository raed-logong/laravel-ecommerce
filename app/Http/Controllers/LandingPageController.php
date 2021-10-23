<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('featured', true)->where('quantity','>',6)->take(8)->inRandomOrder()->get();

        //return view('landing-page')->with('products', $products,'product',$products[0]);
        return view('landing-page')->with([
           'products'=>$products,
           'producthot'=>$products[0]
        ]);
    }
}
