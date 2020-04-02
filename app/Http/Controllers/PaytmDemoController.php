<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order\Payment;

use PaytmWallet;

class PaytmDemoController extends Controller
{
    public function order($id)
    {
      dd($id);
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

