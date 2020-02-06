<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category\Category;
use App\Models\Subcategory\Subcategory;
use App\Models\Product\Product;
use App\Models\Order\wishList;
use App\Models\Product\productReviews;
use DB;
use Carbon\Carbon;


class ProductsController extends Controller
{
    public function getProd($id,$cid)
    {
        // dd($id);
        $subcategory=Subcategory::find($id);
        $category=Category::find($cid);
        $prod=Product::where('subcategory_id',$subcategory->id)->get();
        // dd($prod);
        if(\Auth::user())
        {
            $wished_prod = DB::table('wishlist')
                      ->select('product_id')
                      ->where('user_id','=',\Auth::user()->id) 
                      ->get()
                      ->pluck('product_id')
                      ->toArray();
                    //dd($wished_prod); 
        }
        return view('frontend_user.products_list',compact('prod','subcategory','category','wished_prod'));
    }
    public function detailProd($id,$subid,$cid)
    {
        $category=Category::find($cid);
        $subcategory=Subcategory::find($subid);
        $product=Product::find($id);

        if(\Auth::user())
        {
            $wished_prod = DB::table('wishlist')
                      ->select('product_id')
                      ->where('user_id','=',\Auth::user()->id) 
                      ->get()
                      ->pluck('product_id')
                      ->toArray();
                    //dd($wished_prod); 
        }

        $users_product_reviews=DB::table('users')
        ->join('productreviews','users.id','=','productreviews.user_id')
        ->select('users.*','productreviews.*')
        ->where('productreviews.product_id',$id)
        ->orderBy('productreviews.rating','desc')->get();

        $all_products=DB::table('products')->
        join('productreviews','products.id','=','productreviews.product_id')->select('products.*','productreviews.*')
       ->where('products.category_id',$cid)
        ->orderBy('rating','desc')->get()->keyBy('subcategory_id');
        // dd($all_products);
        $avg=$product_review_avg=productReviews::where('product_id',$id)->get()->avg('rating');
        return view('frontend_user.product-details',compact('product','users_product_reviews','avg','category','subcategory','all_products','wished_prod'));
    }
}

