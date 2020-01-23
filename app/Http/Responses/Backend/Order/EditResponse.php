<?php

namespace App\Http\Responses\Backend\Order;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Order\Order
     */
    protected $orders;

    /**
     * @param App\Models\Order\Order $orders
     */
    public function __construct($orders)
    {
        $this->orders = $orders;
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
        return view('backend.orders.edit')->with([
            'orders' => $this->orders
        ]);
    }
}