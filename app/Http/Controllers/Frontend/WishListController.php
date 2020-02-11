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
            $final_data= parent::__construct();
            $wishlist=$final_data[3];
            
            $response['wishlist']=$wishlist;
            
            if($var){
                $str='<a href="javascript:void(0)" data-tip="Remove from Wishlist" pid="'.$id.'" class="remove-wishlist m-t-8 btn " id="'.$id.'"><i class="fa fa-minus-circle"></i></a>';
                $response['tag']=$str;
                echo json_encode($response);
            }
            else{
                $str='<a href="javascript:void(0)" data-tip="Add to Wishlist" class="add-wishlist m-t-8 btn" pid="'.$id.'"><i class="fa fa-shopping-bag"></i></a>';
                $response['tag']=$str;
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
            $final_data= parent::__construct();
            $wishlist=$final_data[3];
            $response['wishlist']=$wishlist;
            if($var == 1){
                $str='<a href="javascript:void(0)" data-tip="Add to Wishlist" pid="'.$id.'" class="add-wishlist m-t-8 btn"><i class="fa fa-shopping-bag"></i></a>';
                $response['tag']=$str;
                echo json_encode($response);
            }
            else{
                $str='<a href="javascript:void(0)" data-tip="Remove from Wishlist" pid="'.$id.'" class="remove-wishlist m-t-8 btn"><i class="fa fa-minus-circle"></i></a>';
                $response['tag']=$str;
                echo json_encode($response);
            }       
        //return redirect()->route('frontend.index');    
    }

    public function list($id)
    {
        $final_data= parent::__construct();
        $all_cart=$final_data[2];
        $wishlist=$final_data[3];
        $wished_products = DB::table('products')
                         ->join('wishlist','products.id','=','wishlist.product_id')
                         ->select('products.id','products.image','products.product_name','products.price','products.discouted_price')
                         ->where('wishlist.user_id','=',$id)
                         ->get();
        //dd($wished_products);                 

        return view('frontend_user.wishlist')->with([
            'wished_products'=>$wished_products,
            'wishlist'=>$wishlist,
            'all_cart'=>$all_cart
        ]);
    }



}

