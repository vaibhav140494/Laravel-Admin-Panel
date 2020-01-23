<?php

namespace App\Http\Responses\Backend\Offer;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Offer\Offer
     */
    protected $offers;

    /**
     * @param App\Models\Offer\Offer $offers
     */
    public function __construct($offers)
    {
        $this->offers = $offers;
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
        return view('backend.offers.edit')->with([
            'offers' => $this->offers
        ]);
    }
}