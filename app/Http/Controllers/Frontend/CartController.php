<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order\cart;
use App\Models\Product\Product;
use app\Models\Access\User\MultipleAddress;
use App\Models\Settings\Setting;
use DB;
use Illuminate\Support\Str;
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
                $productPrice=Product::select('price')->where('id',$id)->get()->first();
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
                    $cid=DB::table('cart')
                    ->select('cart_id')
                    ->where('user_id','=',\Auth::user()->id)
                    ->get();
                    //dd($cid);
                    $cart = new cart;
                    $cart->product_id = $product->id;
                    $cart->user_id = \Auth::user()->id;
                    $cart->gross_amount = $total;
                    $cart->tax_amount = $taxamt;
                    $cart->quantity = $value;
                    $cart->total_amount = $total;
                    if($cid->count()>0)
                    {
                        $cart->cart_id=$cid[0]->cart_id;
                    }
                    else{
                        //dd('hello');
                        $cart->cart_id= Str::random(15);
                                         
                    }
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
            ->where('user_id',\Auth::user()->id)->get();
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
            ->where('user_id',\Auth::user()->id)->get();
            $response['cart']=$total_cart;

            return json_encode($response);
        }

    }
    public function checkout()
    {
        //dd(\Auth::user()->first_name);
        //dd($request->input('subtotal'));
        //dd($discp);
        $all_category=$this->final_data[0];
        $all_subcategory=$this->final_data[1];
        $all_cart=$this->final_data[2];
        $category_featured=$this->final_data[3];
        $all_products=$this->final_data[5];
        $total=0;
        $address = DB::table('multiple_address')
                    ->where('user_id','=',\Auth::user()->id)
                    ->get();
                   //dd($address);
        $checkout_prod = DB::table('cart')
                        ->join('products','products.id','=','cart.product_id')
                        ->select('products.product_name','products.price','cart.quantity','cart.offer_id','cart.tax_amount')
                        ->where('cart.user_id','=',\Auth::user()->id)
                        ->get();

                        foreach($checkout_prod as $product)
                        {
                            $total+=($product->price) * ($product->quantity);
                        }
                        $total+=$total*($checkout_prod[0]->tax_amount)/100;
                  if($checkout_prod[0]->offer_id)      
                 {
                     $offer = DB::table('offers')
                        ->where('id','=',$checkout_prod[0]->offer_id)
                        ->get();
                       // dd($offer);
                 
               
                if($offer[0]->offer_type == 1 )
                {
                    $discount = $offer[0]->offer_value;
                    $discounted_price = $total-$discount;
                    
                }
                else{
                    $discount = $total * ($offer[0]->offer_value)/100;
                    if($discount > $offer[0]->max_discount)
                    {
                        $discount=$offer[0]->max_discount;
                    }
                    if($discount < $offer[0]->min_offer_amount)
                    {
                        $discount=$offer[0]->min_offer_amount;
                    }
                    $discounted_price = $total-$discount;
                   // dd($discounted_price);
                    
                }    
            }  
            else{
                $discount=0;
                $discounted_price=$total;
            }                 
                       // dd($checkout_prod);
        return view('frontend_user.checkout')->with([
                'address'=>$address,
                'checkout_prod'=>$checkout_prod,
                'all_category'=>$all_category,
                'all_products'=>$all_products,
                'total'=>$total,
                'discount'=>$discount,
                'discounted_price'=>$discounted_price

        ]);                            
    }
}
