<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product_count=Product::all()->where('vendor_id',auth()->user()->id)->count();
        return view('vendor.vendor_dashboard',compact('product_count'));
    }
    public function chat(){
        return view('chat.chat');
    }
}
