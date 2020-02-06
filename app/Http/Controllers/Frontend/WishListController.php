<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order\wishList;
use DB;


class WishListController extends Controller{
    
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
            
            if($var){
                return '<a href="javascript:void(0)" data-tip="Remove from Wishlist" pid="'.$id.'" class="remove"><i class="fa fa-minus-circle"></i></a>';
            }
            else{
                return '<a href="javascript:void(0)" data-tip="Add to Wishlist" class="add" pid="'.$id.'"><i class="fa fa-shopping-bag"></i></a>';
            } 
            //return redirect()->route('frontend.index');
        }
        else{
            return 0;
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
            if($var == 1){
                return '<a href="javascript:void(0)" data-tip="Add to Wishlist" class="add" pid="'.$id.'"><i class="fa fa-shopping-bag"></i></a>';
            }
            else{
                return '<a href="javascript:void(0)" data-tip="Remove from Wishlist" pid="'.$id.'" class="remove"><i class="fa fa-minus-circle"></i></a>';
            }       
        //return redirect()->route('frontend.index');    
    }

    public function list($id)
    {
        $wished_products = DB::table('products')
                         ->join('wishlist','products.id','=','wishlist.product_id')
                         ->select('products.id','products.image','products.product_name','products.price','products.discouted_price')
                         ->where('wishlist.user_id','=',$id)
                         ->get();
        //dd($wished_products);                 

        return view('frontend_user.wishlist')->with([
            'wished_products'=>$wished_products
        ]);
    }



}

