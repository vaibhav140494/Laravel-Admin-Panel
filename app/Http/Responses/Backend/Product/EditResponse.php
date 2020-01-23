<?php

namespace App\Http\Responses\Backend\Product;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Product\Product
     */
    protected $products;

    /**
     * @param App\Models\Product\Product $products
     */
    public function __construct($products)
    {
        $this->products = $products;
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
        return view('backend.products.edit')->with([
            'products' => $this->products
        ]);
    }
}