<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Category\Category;
use App\Models\Subcategory\Subcategory;
use App\Models\Order\cart;
use App\Models\Product\Product;
use DB;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $final_data=array();
    public $cat;
    public $subcat;
    public $cart;
    public $uid;
    public $wishlist;
    public $count;
    public $catarr = Array();
    public function __construct()
    {
        $this->cat=Category::where('is_active',1)->get();
        for($i=0;$i<$this->cat->count();$i++)
        {
            $this->subcat[$this->cat[$i]->id]=Subcategory::where('category_id',$this->cat[$i]->id)->where('is_active',1)->get();
        }

        $this->middleware(function ($request, $next) {
            if(\Auth::user()!=null){
                $this->uid= \Auth::user()->id;
                $this->cart= DB::table('cart')
                ->leftjoin('products','cart.product_id','=','products.id')
                ->select('cart.*','products.product_name','products.image','products.price')
                ->where('user_id',$this->uid)
                ->where('cart.order_id',null)->get();
                $this->wishlist= DB::table('wishlist')->leftjoin('products','wishlist.product_id','=','products.id')
                ->select('wishlist.*','products.product_name','products.quantity','products.image','products.price')
                ->where('user_id',$this->uid)->get();
            }
                //for fetching featured category
                
                $this->count = DB::table('products')->selectRaw('products.category_id, count(products.id) as total')
                ->join('order_details','products.id','=','order_details.product_id')
                ->groupBy('order_details.product_id')
                ->orderBy('total','desc')->get();
                $max = 0;
                for($i=0;$i<$this->count->count();$i++)
                {
                    $this->catarr[$i]=$this->count[$i]->category_id;
                    if($max<$this->count[$i]->total)
                    {
                        $max=$this->count[$i]->total;
                        $catid=$this->count[$i]->category_id;   
                    }   
                }
                $category_featured = Category::findMany($this->catarr);
                $all_products=Product::all();
                // dd($all_products);
                $this->final_data[0]=$this->cat;
                $this->final_data[1]=$this->subcat;
                $this->final_data[2]=$this->cart;
                $this->final_data[3]=$category_featured;
                $this->final_data[5]=$all_products;
                $this->final_data[4]=$this->wishlist;
                // $this->this->catarr=$this->catarr;
                // dd($this->cart);
            return $next($request);
        });
    }


}
