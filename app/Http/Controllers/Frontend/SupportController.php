<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Access\User\User;
use App\Models\Order\Order;
use DB;

class SupportController extends Controller
{
    public function index(Request $req)
    {   
        $user = \Auth::user();
        if(isset($user))
        {
        $all_cart=$this->final_data[2];
        $category_featured=$this->final_data[3];
        $wishlist=$this->final_data[4];
        $all_products=$this->final_data[5];
        //dd("welcome");
      $orders = DB::table('orders')
                ->select('id','order_id')
                ->where('user_id','=',\Auth::user()->id)
                ->get();
       $topics = DB::table('topics')
                ->select('id','topic')
                ->where('is_active','=',1)
                ->get();
        $tickets = DB::table('supporttickets')
                    ->join('topics','supporttickets.topic_id','=','topics.id')
                    ->leftjoin('orders','supporttickets.order_id','=','orders.id')
                    ->select('topics.topic','orders.order_id','supporttickets.status')
                    ->get();  
                    //dd($tickets);               
       // dd($orders);
        return view('frontend_user.support')->with([
            'tickets'=>$tickets,
            'orders'=>$orders,
            'topics'=>$topics,
            'wishlist'=>$wishlist,
            'all_cart'=>$all_cart,
            'category_featured'=>$category_featured,
            'all_products'=>$all_products
        ]);
        }
        else{
            return view('frontend_user.login');
        }
    }

    public function storeTicket(Request $req)
    {
     $input=$req->except('_token');
     //dd($input);
     $ticket_id=mt_rand(1000000000,9999999999);
     if($input['orders'] != 'other')
     {
         $ticket = DB::table('supporttickets')->insert([
             'user_id'=>\Auth::user()->id,
             'topic_id'=>$input['subject'],
             'order_id'=>$input['orders'],
             'ticket_id'=>$ticket_id,
             'discription'=>$input['message'],
             'status'=>'generated',
         ]);
     }
     else{
        $ticket = DB::table('supporttickets')->insert([
            'user_id'=>\Auth::user()->id,
            'topic_id'=>$input['subject'],
            'order_id'=>"null",
            'ticket_id'=>$ticket_id,
            'discription'=>$input['message'],
            'status'=>'generated',
        ]);
     }
     //dd($ticket); 
     if($ticket)
     {
         $ticket_submit = "set";
         return redirect()->route('frontend.index')->with([
             'ticket_submit'=>$ticket_submit
         ]);
     }  
    }
}
