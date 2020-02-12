<?php

namespace App\Http\Responses\Backend\Subcategory;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Subcategory\Subcategory
     */
    protected $subcategories;

    /**
     * @param App\Models\Subcategory\Subcategory $subcategories
     */
    public function __construct($subcategories)
    {
        $this->subcategories = $subcategories;
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
        return view('backend.subcategories.edit')->with([
            'subcategories' => $this->subcategories
        ]);
    }
}