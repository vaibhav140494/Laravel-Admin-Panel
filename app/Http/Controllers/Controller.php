<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Category\Category;
use App\Models\Subcategory\Subcategory;
use App\Models\Order\cart;
use DB;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $final_data=array();
    public $cat;
    public $subcat;
    public $cart;
    public $uid;
    public $wishlist;
    public function __construct()
    {
         $this->cat=Category::where('is_active',1)->get();
        //  dd($cat);
        for($i=0;$i<$this->cat->count();$i++)
        {
            $this->subcat[$this->cat[$i]->id]=Subcategory::where('category_id',$this->cat[$i]->id)->where('is_active',1)->get();
        }
        // $this->uid= $this->middleware('auth')->Auth::user() ;

        $this->middleware(function ($request, $next) {
            if(\Auth::user()!= null){    
            $this->uid= \Auth::user()->id;
            }
    
            return $next($request);
        });

        // $this->uid=\Auth::user()->id;
        $this->cart= DB::table('cart')->leftjoin('products','cart.product_id','=','products.id')
        ->select('cart.*','products.product_name','products.image')
        ->where('user_id',$this->uid)->get();
        $this->wishlist= DB::table('wishlist')->leftjoin('products','wishlist.product_id','=','products.id')
        ->select('wishlist.*','products.product_name','products.image','products.price')
        ->where('user_id',$this->uid)->get();
        
        
        $this->final_data[0]=$this->cat;
        $this->final_data[1]=$this->subcat;
        $this->final_data[2]=$this->cart;
        $this->final_data[3]=$this->wishlist;
        return $this->final_data;
    }


}
