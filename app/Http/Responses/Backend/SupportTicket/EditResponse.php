<?php

namespace App\Http\Responses\Backend\SupportTicket;

use Illuminate\Contracts\Support\Responsable;
use DB;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\SupportTicket\SupportTicket
     */
    protected $supporttickets;

    /**
     * @param App\Models\SupportTicket\SupportTicket $supporttickets
     */
    public function __construct($supporttickets)
    {
       // dd($supporttickets->id);
        $this->supporttickets = DB::table('supporttickets')
                            ->leftjoin('users','users.id','=','supporttickets.user_id')
                            ->leftjoin('topics','topics.id','=','supporttickets.topic_id')
                            ->leftjoin('orders','orders.id','=','supporttickets.order_id')
                            ->select('supporttickets.*','users.first_name','users.last_name','topics.topic','orders.order_id as oid')
                            ->where('supporttickets.id','=',$supporttickets->id)
                            ->get();
                            //dd($this->supporttickets);
        
    }

    /**
     * To Response
     *
     * @param \App\Http\Requests\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
       //dd($this->supporttickets);
        return view('backend.supporttickets.edit')->with([
            'supporttickets' => $this->supporttickets
        ]);
    }
}