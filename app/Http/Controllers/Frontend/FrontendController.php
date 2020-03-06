<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Settings\Setting;
use App\Repositories\Frontend\Pages\PagesRepository;
use App\Models\Category\Category;
use App\Models\Order\Order;
use App\Models\Order\orderDetails;
use App\Models\Order\wishList;
use App\Models\Product\Product;
use App\Models\Product\productReviews;
use App\Models\Subcategory\Subcategory;
use App\Models\Access\User\User;
use DB;
/**
 * Class FrontendController.
 */
class FrontendController extends Controller
{
    public function __construct()
    {
        
        parent::__construct();
        // dd($this->final_data);
    }
    /**
     * @return \Illuminate\View\View
     */
    
    public function index()
    {
        $all_category = $this->final_data[0];
        $all_subcategory = $this->final_data[1];
        $all_cart = $this->final_data[2];
        $category_featured = $this->final_data[3];
        $wishlist = $this->final_data[4];
        $all_products = $this->final_data[5];
        $cart_item=$this->final_data[6];
        $wished_prod=$this->final_data[7];
        $catarr = $this->catarr;
         $product = $all_products;
        $category = Category::all();
        $featured_prod = Product::findMany($catarr);
        $product_review = productReviews::all();
        $otherimg=array();
        foreach($product as $p)
        {
        
           $img = DB::table('productimages')
                                  ->where('product_id',$p['id'])
                                  ->pluck('product_image')->toArray();
                                  //dd($img->product_image);
            $p['other']=$img;                 
        }
        foreach($featured_prod as $p)
        {
        
           $img = DB::table('productimages')
                                  ->where('product_id',$p['id'])
                                  ->pluck('product_image')->toArray();
                                  //dd($img->product_image);
            $p['other']=$img;                 
        }
    
       // dd($product[0]);
       // dd($product[0]->otherimg->product_image);
        //fetching featured Productss
        $featured_prod = DB::table('products')
        ->leftjoin('categories','products.category_id','=','categories.id')
        ->whereIn('categories.id',$catarr)
        ->where('products.is_active',1)
        ->where('products.quantity','>',0)
        ->select('products.*')->get();
        $product_review = productReviews::selectRaw('avg(rating) as avg')->groupby('user_id')->get();
        foreach($featured_prod as $p)
        {
        
           $img = DB::table('productimages')
                                  ->where('product_id',$p->id)
                                  ->pluck('product_image')->toArray();
                                  //dd($img->product_image);
            $p->other=$img;                 
        }
        //dd($featured_prod);
        //  fetching user Reviews  

        $product_review_random = DB::table('users')
        ->join('productreviews','users.id','=','productreviews.user_id')
        ->select('users.first_name as fname' ,'users.last_name as lname','productreviews.*')
        ->whereIn('rating',[5,4])->limit(3)->get()->random(3);

        return view('frontend_user.index', compact('category_featured','all_category','product','featured_prod','product_review','product_review_random','all_subcategory','all_cart','wished_prod','all_products','cart_item','wishlist','category'));
    }

    /**
     * show page by $page_slug.
     */
    public function showPage($slug, PagesRepository $pages)
    {
        $result = $pages->findBySlug($slug);

        return view('frontend.pages.index')
            ->withpage($result);
    }
   
}