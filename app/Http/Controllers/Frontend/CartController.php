<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order\cart;
use App\Models\Product\Product;
use DB;

class CartController extends Controller
{
    // public $all_cart;
    public function __construct()
    {
        parent::__construct();
        // $this->all_cart=$final_data[2];
        // dd($final_data[2]);
    }
    public function add(Request $req)
    {    
        // $final_data= parent::__construct();
        $all_cart=$this->final_data[2];
        // $total_cart=$all_cart;
        // dd($all_cart);
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
               // dd($id);
                // // $cart=DB::table('cart')->join('products','cart.product_id','=','products.id')
                // ->select('cart.*,products.*')->get();
                $cart1 = cart::where('product_id',$id)
                ->where('user_id',\Auth::user()->id)->get()->first();
                //dd($cart1);
                // $response['data']=$cart1;
                if($cart1)
                {   
                    if($cart1->quantity!=$value)
                    {
                        $cart1->quantity=$value;
                        $cart1->total_amount=$value * $cart1->gross_amount;
                        $cart1->save();
                        $response['cart']=$cart1;
                        // dd($cart1);
                    }
                    $response['message']='replace';
                    // echo "helo";
                    // $cart1->quantity=$value;
                    // $cart1->total_amount= $value * $cart1->gross_amount;
                    // dd($cart1->total_amount);
                    // if($cart1->save())
                    // {
                    //     // $response['data']=$cart1;
                    //     $response['message']="success";

                    // }    
                    // $response['data']=$all_cart;
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
            // DB::table('cart')->join('products')
            $total_cart= DB::table('cart')->leftjoin('products','cart.product_id','=','products.id')
            ->select('cart.*','products.product_name','products.image')
            ->where('user_id',\Auth::user()->id)->get();
            $response['cart']=$total_cart;
        }
        return json_encode($response);
    }
    public function show()
    {
        // $id=\Auth::user()->id;
        // dd(\Auth::user()->id);
        // $final_data= parent::__construct();
        $all_category=$this->final_data[0];
        $all_subcategory=$this->final_data[1];
        $all_cart=$this->final_data[2];
        $category_featured=$this->final_data[3];
        $catarr=$this->catarr;
        // dd($all_cart);

        $cart_product=DB::table('products')
        ->join('cart','cart.product_id','=','products.id')
        ->where('cart.user_id',\Auth::user()->id)
        ->select('products.*','cart.*')->get();

        return view('frontend_user.cart',compact('cart_product','all_category','all_subcategory','all_cart','category_featured'));
    }

    public function remove(Request $req)
    {
        // $total_cart=$this->all_cart;
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
            $total_cart= DB::table('cart')->leftjoin('products','cart.product_id','=','products.id')
            ->select('cart.*','products.product_name','products.image')
            ->where('user_id',\Auth::user()->id)->get();
            $response['cart']=$total_cart;

            return json_encode($response);
        }

    }
}
