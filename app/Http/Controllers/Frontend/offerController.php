<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order\Order;
use Carbon\Carbon;
use DB;
use App\Models\Offer\Offer;

class offerController extends Controller
{
    public function offerValidation(Request $request)
    {
        $code = $request->input('code');
        $total = $request->input('total');
        $date = new Carbon;
        //dd($date);
        $offer = DB::table('offers')
                ->where('offer_code','=',$code)
                ->get();
        $count = DB::table('orders')
                ->where([
                    ['offer_id','=',$offer[0]->id],
                    ['user_id','=',\Auth::user()->id]
                ])->get()->count();        
                //dd($count);
        if($offer->count()==1)
        {
            if($offer[0]->is_active == 1)
            {
                if($total >= $offer[0]->min_order_value )
                {
                    if($date < $offer[0]->start_date)
                    {
                        $response['error']='IT`S EARLY TO USE THIS OFFER';
                        echo json_encode($response);

                    }
                    else{
                       if($date > $offer[0]->end_date)
                       {
                        $response['error']='OFFER IS EXPIRED';
                        echo json_encode($response);
                       }
                       else{
                           if($count == $offer[0]->no_of_counts)
                           {
                            $response['error']='YOU HAVE USED THIS OFFER MAXIMUM TIME';
                            echo json_encode($response);
                           }
                           else{
                            $response['success']="offer applide";

                            if($offer[0]->offer_type == 1 )
                            {
                                $discount = $offer[0]->offer_value;
                                $discounted_price = $total-$discount;
                                $response['discount']=$discount;
                                $response['discounted_price']=$discounted_price;
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
                                $response['discount']=$discount;
                                $response['discounted_price']=$discounted_price;
                            }
                            echo json_encode($response);

                           }
                       }
                    }
                }
                else{
                    $response['error']='MINIMUM ORDER VALUE IS NOT SATISFIED';
                    echo json_encode($response);
                }
            }
            else{
            $response['error']='Offer is not availabel now';
            echo json_encode($response);
            }
        }
        else{

            $response['error']='Invalid code';
            echo json_encode($response);
        }        
    } 
}
