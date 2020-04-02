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
use Illuminate\Support\Str;

class OrderController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

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
            // dd($total);                   
        }
        $total=$gross+$gross * ($ordered_prod[0]->tax_amount)/100;
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
    // dd($total_amount);
    $order_id=DB::table('orders')
                ->select('id')
                ->where('order_id','=',$oid)
                ->get();
        $qry='';
        foreach($ordered_prod as $product)
        {
            $gamount=($product->price)*($product->quantity);
            $total_amt=$gamount+$gamount * ($product->tax_amount)/100;
            $qry .= "($product->id, ".$order_id[0]->id.",$product->quantity,$gamount,$product->tax_amount,$total_amt),";
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

        return redirect()->route('frontend.payment',[$oid]);
    }
    public function viewOrder()
    {
        $all_category = $this->final_data[0];
        $all_subcategory = $this->final_data[1];
        $all_cart = $this->final_data[2];
        $category_featured = $this->final_data[3];
        $all_products = $this->final_data[5];
        $catarr = $this->catarr;

        $orders= DB::table('orders')
        ->leftjoin('users','users.id','=','orders.user_id')
        ->leftjoin('order_details','orders.id','=','order_details.order_id')
        ->leftjoin('multiple_address','users.default_address','=','multiple_address.id')
        ->select('orders.*',DB::raw('sum(order_details.total_amount) as total_amount'),DB::raw('sum(order_details.tax_amount) as tax_amount'),DB::raw('CONCAT(users.first_name," ",users.last_name) as user_name'),'users.phone_no','multiple_address.country','multiple_address.state','multiple_address.city','multiple_address.address','multiple_address.pincode')
        ->where('orders.user_id',\Auth::user()->id)->get();
        
        // dd($orders);
        
        
        // dd($order_details);
        return view('frontend_user.view_order',compact('orders','all_category','all_subcategory','all_cart','category_featured','all_products'));
    }

    public function viewOrderDetails($id)
    {
        $all_category = $this->final_data[0];
        $all_subcategory = $this->final_data[1];
        $all_cart = $this->final_data[2];
        $category_featured = $this->final_data[3];
        $all_products = $this->final_data[5];
        $catarr = $this->catarr;

        $order_details=DB::table('orders')
        ->leftjoin('order_details','orders.id','=','order_details.order_id')
        ->leftjoin('products','products.id','=','order_details.product_id')
        ->leftjoin('offers','orders.offer_id','=','offers.id')
        ->select('orders.*','order_details.product_id','order_details.id as ordersdetails_id','order_details.quntity','order_details.gross_amount','order_details.tax_amount','products.price','order_details.total_amount','products.product_name','offers.offer_code')
        ->where('orders.id',$id)
        ->get();
        // dd($order_details);
        return view('frontend_user.view_order_details_user',compact('order_details','all_category','all_subcategory','all_cart','category_featured','all_products'));
    }


    public function order($id)
    {
        
        $payment = PaytmWallet::with('receive');
        if(\Auth::user()){
          $i=7;
          $url=url('/payment/status');
          $payment->prepare([
            'order' => 29,
            'user' => 4,
            'mobile_number' => \Auth::user()->phone_no,
            'email' => \Auth::user()->email,
            'amount' => 30,
            'callback_url' => url('payment/status')
          ]);
          return $payment->receive();
          // return $payment->view('frontend_user.demo_paytm_view')->receive();
        }
        else
        {
          return redirect()->route('frontend.user.login');
        }
    }

      /**
     * Obtain the payment information.
     *
     * @return Object
     */
    public function paymentCallback()
    {
        $transaction = PaytmWallet::with('receive');
        $response = $transaction->response();
        $order_id=$transaction->getOrderId(); // To get raw response as array
        //Check out response parameters sent by paytm here -> http://paywithpaytm.com/developer/paytm_api_doc?target=interpreting-response-sent-by-paytm
        $tid=$transaction->getTransactionId();
        $payment=new Payment();
        $payment->order_id=12;
        $payment->user_id=5;
        $payment->status="success";
        $payment->banktransaction_id=123;
        $payment->transaction_id=$tid;
        $payment->amount=30;
        $payment->save();
        // dd($payment);
         return redirect()->route('frontend.index');
        if($transaction->isSuccessful()){
          //Transaction Successful
          
        }else if($transaction->isFailed()){
          //Transaction Failed
        }else if($transaction->isOpen()){
          //Transaction Open/Processing
        }
        $transaction->getResponseMessage(); //Get Response Message If Available
        //get important parameters via public methods
        $transaction->getOrderId(); // Get order id
        $transaction->getTransactionId();// Get transaction id 
    }  
    
    public function statusCheck(){
        $status = PaytmWallet::with('status');
        $status->prepare(['order' => 27]);
        $status->check();
        $response = $status->response();
        // To get raw response as array
        //Check out response parameters sent by paytm here -> http://paywithpaytm.com/developer/paytm_api_doc?target=txn-status-api-description
        $status->getResponseMessage();
        //get important parameters via public methods
       $oid= $status->getOrderId(); // Get order id
       $tid= $status->getTransactionId(); // Get transaction id
        dd($status);
        if($status->isSuccessful()){
          //Transaction Successful
        $payment=new Payment();
        $payment->order_id=11;
        $payment->user_id=4;
        $payment->status="success";
        $payment->banktransaction_id=123;
        $payment->transaction_id=$tid;
        $payment->amount=30;
        $payment->save();
          // dd($payment);
        }else if($status->isFailed()){
          //Transaction Failed
        }else if($status->isOpen()){
          //Transaction Open/Processing
        }
        
    }
}

