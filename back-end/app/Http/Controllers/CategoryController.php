<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\SubCategory;
class CategoryController extends Controller
{
    public function index(){
        $categories=Category::all();
        return response(['categories'=>$categories]);
    }
    public function fetch_sub_category($name){
        $category=Category::where('name',$name)->get('id')->first();

        $sub_categories=SubCategory::where('category_id',$category->id)->get();


        return response(['sub_categories'=>$sub_categories,'category_id'=>$category->id]);
    }
}
