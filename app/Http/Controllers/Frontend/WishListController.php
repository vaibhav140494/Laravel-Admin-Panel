<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order\wishList;
use App\Models\Product\Product;
use DB;


class WishListController extends Controller{
    public function __construct()
    {      
        parent::__construct();
    }
    public function add(Request $request)
    {
        if(\Auth::user())
        {
            
            //dd(\Auth::user()->id);
            $id=$request->input('id');
            //dd($id);
            $var = DB::table('wishlist')->insert([
                'user_id'=>\Auth::user()->id,
                'product_id'=>$id
            ]);
            $data = DB::table('wishlist')->leftjoin('products','wishlist.product_id','=','products.id')
            ->select('wishlist.*','products.product_name','products.image','products.price')
            ->where('user_id',$this->uid)->get();
            //$wishlist=$this->final_data[4];
            $wishlist=$data;
           // dd($wishlist);
            $response['wishlist']=$wishlist;
            
            if($var){
                
                $response['tag']="remove";
                echo json_encode($response);
            }
            else{
                
                $response['tag']="add";
                echo json_encode($response);
            } 
            //return redirect()->route('frontend.index');
        }
        else{
              $response['msg']="fail";
              echo json_encode($response);
        }
    }

    public function remove(Request $request)
    {
        $id=$request->input('id');
        //dd($id);
        $var = DB::table('wishlist')->where([
            ['user_id','=',\Auth::user()->id],
            ['product_id','=',$id]
            ])->delete();
            //dd($var);
            $data = DB::table('wishlist')->leftjoin('products','wishlist.product_id','=','products.id')
            ->select('wishlist.*','products.product_name','products.image','products.price')
            ->where('user_id',$this->uid)->get();
            $wishlist=$data;
            $response['wishlist']=$wishlist;
            if($var == 1){
                
                $response['tag']="add";
                $response['msg']="success";
                echo json_encode($response);
            }
            else{
                
                $response['tag']="remove";
                $response['msg']="fail";
                echo json_encode($response);
            }       
        //return redirect()->route('frontend.index');    
    }

    public function list($id)
    {
        $all_cart=$this->final_data[2];
        $category_featured=$this->final_data[3];
        $wishlist=$this->final_data[4];
        $all_products=$this->final_data[5];
        $wished_products = DB::table('products')
                         ->join('wishlist','products.id','=','wishlist.product_id')
                         ->select('products.id','products.image','products.product_name','products.price','products.quantity','products.discouted_price')
                         ->where('wishlist.user_id','=',$id)
                         ->get();
        //dd($wished_products);                 

        return view('frontend_user.wishlist')->with([
            'wished_products'=>$wished_products,
            'wishlist'=>$wishlist,
            'all_cart'=>$all_cart,
            'category_featured'=>$category_featured,
            'all_products'=>$all_products
        ]);
    }



}

