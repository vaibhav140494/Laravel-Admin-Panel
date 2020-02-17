<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order\cart;
use App\Models\Product\Product;
use App\Models\Settings\Setting;
use DB;

class CartController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    //Add to cart 
    public function add(Request $req)
    {   
        $tax=Setting::select('cgst','sgst')->get()->first();
        // dd($tax);
        $taxamt=$tax->cgst + $tax->sgst;
        $all_cart = $this->final_data[2];
        if(\Auth::user()==null)
        {
            $response['login'] = false;
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
                $productPrice=Product::select('price')->where('id',$id)
                ->get()->first();
                if($cart1)
                {   
                   if($cart1->quantity != $value)
                    {
                        $cart1->gross_amount= $value * $productPrice->price;
                        $total=$cart1->gross_amount;
                        $tax =$total * $taxamt/100;
                        $total +=$tax;
                        $cart1->quantity = $value;
                        $cart1->gross_amount = $value * $cart1->gross_amount;
                        $cart1->total_amount = $total;
                        // $cart1->total_amount = ($total_amount * $taxamt) /100;
                        // dd($cart1);
                        $cart1->save();
                        $response['cart'] = $cart1;
                    }
                    $response['message'] = 'replace';
                    $response['data_replace'] = '<a href="'.route('frontend.cart.show').'"  name="'.$cart1->product_id.'" class="cart-btn" data-tip="view Cart"><i class="ti-shopping-cart"></i></a>';
                }
                else
                {   
                    $product = Product::find($id);
                    $total = $value * $product->price;
                    $tax =$total * $taxamt/100;
                    $total+=$tax;
                    $cart = new cart;
                    $cart->product_id = $product->id;
                    $cart->user_id = \Auth::user()->id;
                    $cart->gross_amount = $total;
                    $cart->tax_amount = $taxamt;
                    $cart->quantity = $value;
                    $cart->total_amount = $total;
                    $cart->save();
                    $response['cart'] = $cart;
                    $response['message'] = 'replace';
                    $response['price']=$productPrice->price;
                    $response['data_replace'] = '<a href="'.route('frontend.cart.show').'"  name="'.$cart->product_id.'" class="cart-btn" data-tip="view Cart"><i class="ti-shopping-cart"></i></a>';
                    $response['message']='success';
                }
            }
            else
            {
                $response['fail'] = 'fail';
            }
            $total_cart = DB::table('cart')->leftjoin('products','cart.product_id','=','products.id')
            ->select('cart.*','products.product_name','products.image','products.price')
            ->where('user_id',\Auth::user()->id)
            ->where('cart.order_id',null)->get();
            $response['cart']=$total_cart;
        }
        return json_encode($response);
    }

    //Show cart items

    public function show()
    {
        $all_category = $this->final_data[0];
        $all_subcategory = $this->final_data[1];
        $all_cart = $this->final_data[2];
        $category_featured = $this->final_data[3];
        $all_products = $this->final_data[5];
        $catarr = $this->catarr;

        $cart_product = DB::table('products')
        ->join('cart','cart.product_id','=','products.id')
        ->where('cart.user_id',\Auth::user()->id)
        ->where('cart.order_id',null)
        ->select('products.*','cart.*')->get();

        return view('frontend_user.cart',compact('cart_product','all_category','all_subcategory','all_cart','category_featured','all_products'));
    }

    //Remove From cart

    public function remove(Request $req)
    {
        if($req->ajax())
        {
            $id = $req->input('pid');
            $cart = cart::find($id);
             $pid = $cart->product_id;
            $ans = $cart->delete();
            
            if($ans)
            {
                $response['message'] = "success";
                $response['data_replace'] = '<a href="javascript:void(0)" prid="'.$pid.'" name="'.$pid.'" class="cart-btn" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a>';
            }
            else
            {
                $response['message'] = "fail";
            }
            $total_cart = DB::table('cart')->leftjoin('products','cart.product_id','=','products.id')
            ->select('cart.*','products.product_name','products.image','products.price')
            ->where('user_id',\Auth::user()->id)
            ->where('cart.order_id',null)->get();
            $response['cart']=$total_cart;

            return json_encode($response);
        }

    }
}
