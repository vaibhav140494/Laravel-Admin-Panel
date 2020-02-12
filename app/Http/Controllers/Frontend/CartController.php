<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order\cart;
use App\Models\Product\Product;
use DB;

class CartController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function add(Request $req)
    {   
        $all_cart=$this->final_data[2];
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
                $cart1 = cart::where('product_id',$id)
                ->where('user_id',\Auth::user()->id)->get()->first();
        
                if($cart1)
                {   
                    if($cart1->quantity!=$value)
                    {
                        $cart1->quantity=$value;
                        $cart1->total_amount=$value * $cart1->gross_amount;
                        $cart1->save();
                        $response['cart']=$cart1;
                    }
                    $response['message']='replace';
                    $response['data_replace'] = '<a href="'.route('frontend.cart.show').'"  name="'.$cart1->product_id.'" class="cart-btn" data-tip="view Cart"><i class="ti-shopping-cart"></i></a>';
                }
                else
                {   
                
                    $product=Product::find($id);
                    $total = $value * $product->price;
                    $cart=new cart;
                    $cart->product_id=$product->id;
                    $cart->user_id=\Auth::user()->id;
                    $cart->gross_amount=$product->price;
                    $cart->tax_amount=0;
                    $cart->quantity=$value;
                    $cart->total_amount=$total;
                    $cart->save();
                    //dd($cart);
                    $response['cart']=$cart;
                    $response['message']='replace';
                    $response['data_replace'] = '<a href="'.route('frontend.cart.show').'"  name="'.$cart->product_id.'" class="cart-btn" data-tip="view Cart"><i class="ti-shopping-cart"></i></a>';
                    $response['message']='success';
                }
            }
            else
            {
                $response['fail']='fail';
            }
            $total_cart= DB::table('cart')->leftjoin('products','cart.product_id','=','products.id')
            ->select('cart.*','products.product_name','products.image')
            ->where('user_id',\Auth::user()->id)->get();
            $response['cart']=$total_cart;
        }
        return json_encode($response);
    }
    public function show()
    {
        $all_category=$this->final_data[0];
        $all_subcategory=$this->final_data[1];
        $all_cart=$this->final_data[2];
        $category_featured=$this->final_data[3];
        $all_products=$this->final_data[5];

        $catarr=$this->catarr;

        $cart_product=DB::table('products')
        ->join('cart','cart.product_id','=','products.id')
        ->where('cart.user_id',\Auth::user()->id)
        ->select('products.*','cart.*')->get();

        return view('frontend_user.cart',compact('cart_product','all_category','all_subcategory','all_cart','category_featured','all_products'));
    }

    public function remove(Request $req)
    {
        if($req->ajax())
        {
            $id=$req->input('pid');
            $cart=cart::find($id);
             $pid=$cart->product_id;
            $ans=$cart->delete();
            
            if($ans)
            {
                $response['message']="success";
                $response['data_replace']='<a href="javascript:void(0)"  name="'.$pid.'" class="cart-btn" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a>';
            }
            else
            {
                $response['message']="fail";
            }
            $total_cart= DB::table('cart')->leftjoin('products','cart.product_id','=','products.id')
            ->select('cart.*','products.product_name','products.image')
            ->where('user_id',\Auth::user()->id)->get();
            $response['cart']=$total_cart;

            return json_encode($response);
        }

    }
}
