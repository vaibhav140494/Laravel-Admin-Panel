<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order\cart;
use App\Models\Product\Product;
use DB;

class CartController extends Controller
{
    public function add(Request $req)
    {   
        if(\Auth::user()==null)
        {
            $response['login']=false;
        }
        else
        {
           if($req->ajax())
            {
                $value = $req->input('value');
                if($value==null){
                    $value=1;

                }
                $id=$req->input('id');
                // $cart=DB::table('cart')->join('products','cart.product_id','=','products.id')
                // ->select('cart.*,products.*')->get();
                $cart1 = cart::where('product_id',$id)
                ->where('user_id',\Auth::user()->id)->get()->first();
                
                $response['data']=$cart1;
                if(isset($cart1))
                {
                    $cart1->quantity=$value;
                    $cart1->total_amount= $value * $cart1->gross_amount;
                    // dd($cart1->total_amount);
                    if($cart1->save())
                    {
                        $response['message']="success";
                    }
                }
                else
                {   
                
                    $product=Product::find($id);
                    // dd($value);
                    $total = $value * $product->price;
                    $cart=new cart;
                    $cart->product_id=$product->id;
                    $cart->user_id=\Auth::user()->id;
                    $cart->gross_amount=$product->price;
                    $cart->tax_amount=0;
                    $cart->quantity=$value;
                    $cart->total_amount=$total;
                    $cart->save();
                   
                    $response['message']='success';
                }
            }
            else
            {
                $response['fail']='fail';
            }

        }
        return json_encode($response);
    }
    public function show()
    {
        // $id=\Auth::user()->id;
        // dd(\Auth::user()->id);
        $final_data= parent::__construct();
        $all_category=$final_data[0];
        $all_subcategory=$final_data[1];
        $all_cart=$final_data[2];
        // dd($all_cart);

        $cart_product=DB::table('products')
        ->join('cart','cart.product_id','=','products.id')
        ->where('cart.user_id',\Auth::user()->id)
        ->select('products.*','cart.*')->get();

        return view('frontend_user.cart',compact('cart_product','all_category','all_subcategory','all_cart'));
    }

    public function remove(Request $req)
    {
        if($req->ajax())
        {
            $id=$req->input('pid');
            // dd($id);
            $cart=cart::find($id);
            $ans=$cart->delete();
            
            if($ans)
            {
                $response['message']="success";
            }
            else
            {
                $response['message']="fail";
            }
            return json_encode($response);
        }

    }
}
