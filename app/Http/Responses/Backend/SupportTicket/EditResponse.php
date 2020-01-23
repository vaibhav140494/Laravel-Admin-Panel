<?php

namespace App\Http\Responses\Backend\SupportTicket;

use Illuminate\Contracts\Support\Responsable;

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
        $this->supporttickets = $supporttickets;
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
        return view('backend.supporttickets.edit')->with([
            'supporttickets' => $this->supporttickets
        ]);
    }
}