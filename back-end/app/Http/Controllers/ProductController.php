<?php

namespace App\Http\Controllers;

use App\Store;
use App\Product;
use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Store $store)
    {

        // $pictures=Product::findOrFail($id);

        if (auth()->user()){
            $products=Product::where('store_id',$store->id)->paginate(5);
            // dd($products);

            return view('product.showProducts',compact('products'));
        }
       else{
           return back();
       }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Store $store)
    {
        // dd($store);

        return view('product.createProduct',compact('store'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $store, Request $request)
    {


        $sub_category=SubCategory::where('name',$request->sub_cat_name)->get('id')->first();
        $sub_category_id=$sub_category->id;
        $product=Product::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'slug'=>$request->name.'-'.'vendor'.auth()->user()->id,
            'product_decription'=>$request->descrption,
            'category_id'=>$request->category_id,
            'product_warranty'=>$request->warrenty,
            'product_stock'=>$request->stock,
            'sub_category_id'=>$sub_category_id,
            'product_rating'=>0,
            'brand_name'=>$request->brand,
            'product_tags'=>"none",
            'product_pictures'=>[],
            'store_id'=>$store->id,
        ]);

        return response(['product'=>$product]);
    }

    public function store_cars(Store $store, Request $request){
        $sub_category=SubCategory::where('name',$request->sub_cat_name)->get('id')->first();
        $sub_category_id=$sub_category->id;
        $product=Product::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'slug'=>$request->name.'-'.'vendor'.auth()->user()->id,
            'product_decription'=>$request->descrption,
            'category_id'=>$request->category_id,
            'product_warranty'=>$request->used,
            'product_stock'=>$request->stock,
            'sub_category_id'=>$sub_category_id,
            'product_rating'=>0,
            'brand_name'=>$request->brand,
            'product_tags'=>"none",
            'product_pictures'=>[],
            'store_id'=>$store->id,
        ]);

        return response(['product'=>$product]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        // dd($product);

        $category=Category::findOrFail($product->category_id);
        $category_name=$category->name;

        return view('product.editProduct',compact('product','category_name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // dd($request);
        $pictures=explode(",",$request->product_pictures);
        $sub_category_id=null;
        if($request->sub_cat){
            $sub_category=SubCategory::where('name',$request->sub_cat)->get('id')->first();
            $sub_category_id=$sub_category->id;
        }

        $product->update([
            'price' => $request->price,
            'product_decription'=> $request->product_description,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'product_pictures'=>$pictures,
            'brand_name' => $request->product_barnd,
            'sub_category_id' => $sub_category_id ? $sub_category_id: $product->sub_category_id,
        ]);

        return response(['message' => 'Product Updated Successfully..!!!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {

        // $product=Product::findOrFail($id);
        $product->delete();
        return redirect()->back()->with(['message'=>'deeleted successfully..']);
    }

    public function store_product_image(Request $request ){
        // dd($request);
        $product=Product::findOrFail($request->product_id);
         //image upload in the file system section
         $imageName = time().'.'.$request->file->getClientOriginalExtension();
         $request->file->move(public_path('images/'.str_replace(' ', '',auth()->user()->name).'/'.$request->store_id.'/products/'.$request->product_id), $imageName);


         $images=array();

       if ($product->product_pictures ===[]){


        array_push($images,'images/'.str_replace(' ', '',auth()->user()->name).'/'.$request->store_id.'/products/'.$request->product_id.'/'.$imageName);

            $product->update([
                'product_pictures' =>$images,
            ]);


       }
       else if(!is_string($product->product_pictures)){


        $images=array_merge($images,$product->product_pictures);

        array_push($images,'images/'.str_replace(' ', '',auth()->user()->name).'/'.$request->store_id.'/products/'.$request->product_id.'/'.$imageName);
           $product->update([
            'product_pictures' =>$images,
         ]);
       }
       else{

        array_push($images,$product->product_pictures);
        array_push($images,'images/'.str_replace(' ', '',auth()->user()->name).'/'.$request->store_id.'/products/'.$request->product_id.'/'.$imageName);
        $product->update([
         'product_pictures' => $images,
      ]);
       }
        return response(['pic'=>$product->product_pictures]);
    }

    public function car_create(Store $store){
        return view('product.cars.createCar',compact('store'));
    }
}
