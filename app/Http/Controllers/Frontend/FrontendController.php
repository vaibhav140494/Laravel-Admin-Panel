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
        // $final_data = parent::__construct();
        // dd($final_data);
        $all_category=$this->final_data[0];
        $all_subcategory=$this->final_data[1];
        $all_cart=$this->final_data[2];
        $category_featured=$this->final_data[3];
        $wishlist=$this->final_data[4];
        $catarr=$this->catarr;
        // dd($catarr);
         $product=Product::all();

        // //for fetching featured category
        
        // $count = DB::table('products')->selectRaw('products.category_id, count(products.id) as total')
        // ->join('order_details','products.id','=','order_details.product_id')
        // ->groupBy('order_details.product_id')
        // ->orderBy('total','desc')->get();
        // $max = 0;
        // $catarr = Array();
        // for($i=0;$i<$count->count();$i++)
        // {
        //     $catarr[$i]=$count[$i]->category_id;
        //     if($max<$count[$i]->total)
        //     {
        //         $max=$count[$i]->total;
        //         $catid=$count[$i]->category_id;   
        //     }   
        // }
        // $category_featured = Category::findMany($catarr);
        $category = Category::all();
        $featured_prod = Product::findMany($catarr);
        // dd($catarr);
        $product_review = productReviews::all();
        if(\Auth::user())
        {
            $wished_prod = DB::table('wishlist')
                      ->select('product_id')
                      ->where('user_id','=',\Auth::user()->id) 
                      ->get()
                      ->pluck('product_id')
                      ->toArray();
        }     

        //fetching featured PROductss

        $featured_prod = DB::table('products')
        ->leftjoin('categories','products.category_id','=','categories.id')
        ->whereIn('categories.id',$catarr)
        ->where('is_active',1)
        ->select('products.*')->get();
        // dd($featured_prod);
        $product_review = productReviews::selectRaw('avg(rating) as avg')->groupby('user_id')->get();
        // dd($product_review);     
        
        //  fetching user Reviews  

        $product_review_random = DB::table('users')
        ->join('productreviews','users.id','=','productreviews.user_id')
        ->select('users.first_name as fname' ,'users.last_name as lname','productreviews.*')
        ->whereIn('rating',[5,4])->limit(3)->get()->random(3);

        return view('frontend_user.index', compact('category_featured','all_category','category','product','featured_prod','product_review','product_review_random','all_subcategory','all_cart','wished_prod','wishlist'));
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
// select *from users where user_id in(select user_id from productreviews where rating in(5,4));