<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order\cart;
use App\Models\Product\Product;
use app\Models\Access\User\MultipleAddress;
use App\Models\Settings\Setting;
use App\Models\Order\Order;
use DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{

    
    public function placeOrder()
    {
    
    $gross=0;
    $total=0;
    $ordered_prod = DB::table('cart')
                        ->join('products','products.id','=','cart.product_id')
                        ->select('products.id','products.product_name','products.price','cart.quantity','cart.offer_id','cart.tax_amount')
                        ->where('cart.user_id','=',\Auth::user()->id)
                        ->get();
    foreach($ordered_prod as $product)
    {
        $gross+=($product->price) * ($product->quantity);
    }
    $total=$gross+$gross * ($ordered_prod[0]->tax_amount)/100;
    //dd($total);                   
    if($ordered_prod[0]->offer_id)      
    {
        $offer = DB::table('offers')
               ->where('id','=',$ordered_prod[0]->offer_id)
               ->get();
              // dd($offer);
        
      
       if($offer[0]->offer_type == 1 )
       {
           $discount = $offer[0]->offer_value;
           $total_amount = $total-$discount;
           
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
           $total_amount = $total-$discount;
          // dd($total_amount);
           
       }    
   }  
   else{
       $discount=0;
       $total_amount=$total;
   }
   $oid=Str::random(15);
   $ord=DB::table('orders')->insert([
       'user_id'=>\Auth::user()->id,
       'offer_id'=>$ordered_prod[0]->offer_id,
       'order_id'=>$oid,
       'gross_amount'=>$gross,
       'tax_amount'=>$ordered_prod[0]->tax_amount,
       'total_amount'=>$total_amount,
       'discount'=>$discount,
       'status'=>'placed',
       'type'=>'1'
   ]);
   $order_id=DB::table('orders')
            ->select('id')
            ->where('order_id','=',$oid)
            ->get();
    $qry='';
    foreach($ordered_prod as $product)
    {
        $gamount=($product->price)*($product->quantity);
        $qry .= "($product->id, ".$order_id[0]->id.",$product->quantity,$gamount,$product->tax_amount,$total_amount),";
    }

    if($qry!='')
    {
        $qry = substr($qry, 0, -1);
        $finalQry = "INSERT INTO `order_details` (`product_id`, `order_id`,`quntity`,`gross_amount`,`tax_amount`,`total_amount`) VALUES ".$qry;
        DB::unprepared($finalQry);
    }
    DB::table('cart')
        ->where('user_id','=',\Auth::user()->id)
        ->update(['order_id'=>$order_id[0]->id]);
        dd('hello');
}
}
