<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order\cart;
use App\Models\Product\Product;
use app\Models\Access\User\MultipleAddress;
use App\Models\Settings\Setting;
use App\Models\Order\Order;
use App\Models\Order\orderDetails;
use DB;
use PDF;
use App\Notifications\PlaceOrder;
use Illuminate\Support\Str;

class OrderController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function placeOrder(Request $req)
    {
        $input = $req->except('_token');
        //dd($input);
        $add_id = $input['address'];
        $inst = $input['instruction'];
        $gross=0;   
        $total=0;
        $tax=Setting::select('cgst','sgst')->get()->first();
        $taxamt=$tax->cgst + $tax->sgst;
        $ordered_prod = DB::table('cart')
            ->join('products','products.id','=','cart.product_id')
            ->select('products.id','products.product_name','products.price','cart.quantity','cart.offer_id','cart.tax_amount')
            ->where([
                ['cart.user_id','=',\Auth::user()->id],
                ['cart.order_id','=',NULL]
                ])->get();
        foreach($ordered_prod as $product)
        {
            $gross+=($product->price) * ($product->quantity);
            // dd($total);                   
        }
        $tax=$gross * ($taxamt)/100;
        $total=$gross+$tax;
        //dd($ordered_prod[0]->offer_id);
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
            
            
        }    
    }  
    else{
        $discount=0;
        $total_amount=$total;
    }
    $oid=mt_rand(1000000000,9999999999);
    $ord=DB::table('orders')->insert([
        'user_id'=>\Auth::user()->id,
        'offer_id'=>$ordered_prod[0]->offer_id,
        'order_id'=>$oid,
        'address_id'=>$add_id,
        'instructions'=>$inst,
        'gross_amount'=>$gross,
        'tax_amount'=>$tax,
        'total_amount'=>$total_amount,
        'discount'=>$discount,
        'status'=>'placed',
        'type'=>'1'
    ]);
    // dd($total_amount);
    $order_id=DB::table('orders')
                ->select('id')
                ->where('order_id','=',$oid)
                ->get();
        $qry='';
        foreach($ordered_prod as $product)
        {
            $gamount=($product->price)*($product->quantity);
            $total_amt=$gamount+$gamount * ($taxamt)/100;
            $qry .= "($product->id, ".$order_id[0]->id.",$product->quantity,$gamount,$product->tax_amount,$total_amt),";
        }

        if($qry!='')
        {
            $qry = substr($qry, 0, -1);
            $finalQry = "INSERT INTO `order_details` (`product_id`, `order_id`,`quntity`,`gross_amount`,`tax_amount`,`total_amount`) VALUES ".$qry;
            DB::unprepared($finalQry);
        }
       $cupdate = DB::table('cart')
            ->where([
                ['user_id','=',\Auth::user()->id],
                ['cart.order_id','=',NULL]
                ])->update(['order_id'=>$order_id[0]->id]);
       // $user = \Auth::user();
        //$user->notify(new PlaceOrder());        
        if($cupdate)
        {
            $order="set";
            return redirect()->route('frontend.index')->with([
                'order'=>$order
            ]);
        }        
    }
    public function viewOrder()
    {
        $all_category = $this->final_data[0];
        $all_subcategory = $this->final_data[1];
        $all_cart = $this->final_data[2];
        $category_featured = $this->final_data[3];
        $wishlist=$this->final_data[4];
        $all_products = $this->final_data[5];
        $catarr = $this->catarr;

        $orders= DB::table('orders')
        ->select('orders.*')
        ->where('orders.user_id',\Auth::user()->id)->get();
        
        // dd($orders);
        
        
        // dd($order_details);
        return view('frontend_user.view_order',compact('orders','wishlist','all_category','all_subcategory','all_cart','category_featured','all_products'));
    }

    public function viewOrderDetails($id)
    {
        $all_category = $this->final_data[0];
        $all_subcategory = $this->final_data[1];
        $all_cart = $this->final_data[2];
        $category_featured = $this->final_data[3];
        $wishlist=$this->final_data[4];
        $all_products = $this->final_data[5];
        $catarr = $this->catarr;

        $order_details=DB::table('orders')
        ->leftjoin('order_details','orders.id','=','order_details.order_id')
        ->leftjoin('products','products.id','=','order_details.product_id')
        ->leftjoin('offers','orders.offer_id','=','offers.id')
        ->select('orders.*','order_details.product_id','order_details.id as ordersdetails_id','order_details.quntity','order_details.gross_amount','order_details.tax_amount','products.price','order_details.total_amount','products.product_name','offers.offer_code')
        ->where('orders.id',$id)
        ->get();
        $discount =$order_details[0]->discount; 
         //dd($order_details);
        return view('frontend_user.view_order_details_user',compact('order_details','discount','wishlist','all_category','all_subcategory','all_cart','category_featured','all_products'));
    }
    public function  pdf($id)
    {
        //dd($id);
        $order_details=DB::table('orders')
        ->leftjoin('multiple_address','multiple_address.id','=','orders.address_id')
        ->leftjoin('order_details','orders.id','=','order_details.order_id')
        ->leftjoin('products','products.id','=','order_details.product_id')
        ->leftjoin('offers','orders.offer_id','=','offers.id')
        ->select('orders.*','multiple_address.*','order_details.product_id','order_details.id as ordersdetails_id','order_details.quntity','order_details.gross_amount','order_details.tax_amount','products.price','order_details.total_amount','products.product_name','offers.offer_code')
        ->where('orders.id',$id)
        ->get();
       // dd($order_details);
       $discount =$order_details[0]->discount; 
       $name = $order_details[0]->order_id;
        if($id){
            $pdf = PDF::loadView('frontend_user.invoice',compact('order_details','discount'));
            return $pdf->download($name.'.pdf');
        }
    }
}

