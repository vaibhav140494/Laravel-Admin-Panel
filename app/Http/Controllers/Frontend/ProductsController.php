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
    // public $all_category; 
    // public $all_subcategory;
    // public $all_cart;
    //   public $wishlist;
    // public $final_data;
    public function __construct()
    {
        parent::__construct();
        // echo "<pre>"; print_r($this); exit;
        // $this->final_data=$final_data;
       
    }

    public function getProd($id,$cid)
    {
        $all_category=$this->final_data[0];
        $all_subcategory=$this->final_data[1];
        $all_cart=$this->final_data[2];
        $category_featured=$this->final_data[3];
        $all_products=$this->final_data[5];
        
        $wishlist=$this->final_data[4];
        $catarr=$this->catarr;
        // echo "<pre>"; print_r($this->uid); exit;

        //  parent::__construct();
        
        // $all_category=$this->all_category;
        // $all_subcategory=$this->all_subcategory;
        // $all_cart=$this->all_cart;
        // );
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

        return view('frontend_user.products_list',compact('prod','subcategory','category','all_category','all_subcategory','all_cart','wished_prod','category_featured','all_products','wishlist'));
    }

    public function detailProd($id,$subid,$cid)
    {
        
        $all_category=$this->final_data[0];
        $all_subcategory=$this->final_data[1];
        $all_cart=$this->final_data[2];
        $category_featured=$this->final_data[3];
        $all_products=$this->final_data[5];
        // dd($all_products);
        $wishlist=$this->final_data[4];
        $catarr=$this->catarr;
            // dd($all_cart);

        // $all_category=$this->all_category;
        // $all_subcategory=$this->all_subcategory;
        // $all_cart=$this->all_cart;
        $category=Category::find($cid);
        $subcategory=Subcategory::find($subid);
       
        $product=DB::table('products')->leftjoin('productreviews','products.id','=','productreviews.product_id')
        ->where('products.id',$id)->
        select('products.*','productreviews.product_id','productreviews.user_id','productreviews.rating','productreviews.review',\DB::raw("ROUND(AVG(rating),2) as avg_rating",'category_featured'))
        ->get()->first();

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

        // dd($product);
        //Count no of reviews
        $count_reviews=productReviews::selectRaw("count(*) as count")->where('product_id',$id)->get()->toArray();
        // dd($count_reviews[0]['count']);
        $users_product_reviews=DB::table('users')
        ->leftjoin('productreviews','users.id','=','productreviews.user_id')
        ->select('users.*','productreviews.product_id','productreviews.user_id','productreviews.rating','productreviews.review','productreviews.review_date')
        ->where('productreviews.product_id',$id)
        ->orderBy('productreviews.rating','desc')->limit(4)->get();
        // dd($users_product_reviews);
       
        $related_products=DB::table('products')->
        leftjoin('productreviews','products.id','=','productreviews.product_id')->select('products.*','productreviews.product_id','productreviews.user_id','productreviews.rating','productreviews.review')
        ->where('products.category_id',$cid)
        ->where('products.id','<>',$id)
        ->orderBy('rating','desc')->get()->keyBy('subcategory_id');
        // dd($related_products);

        $avg=$product_review_avg=productReviews::where('product_id',$id)->get()->avg('rating');
        
        return view('frontend_user.product-details',compact('product','users_product_reviews','category','subcategory','related_products','count_reviews','all_category','all_subcategory','all_cart','wished_prod','category_featured','all_products','wishlist'));
    }

    public function storeReview(Request $req)
    {
        if($req->ajax())
        {
             $id=$req->input('pid');
             $rating=$req->input('rating');
             $review=$req->input('review');
             $preview=new productReviews;
             $preview->user_id=\Auth::user()->id;
             $preview->product_id=$id;
             $preview->rating=$rating;
             $preview->review=$review;
             $preview->review_date=date('Y-m-d');
             if($preview->save())
             {
                 echo "success";
             }
             else
             echo "fail";
             
        }
    }

}

