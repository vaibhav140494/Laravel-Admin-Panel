<?php

namespace App\Http\Responses\Backend\Product;

use Illuminate\Contracts\Support\Responsable;
use DB;
use App\Models\Category\Category;
use App\Models\Subcategory\Subcategory;

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
        //dd($this->products);
        $category_list=DB::table('categories')
        ->select('id','category_name')
        ->get();
        $subcategory_name=DB::table('subcategories')
        ->select('id','subcategory_name')
        ->where('category_id','=',$this->products['category_id'])
        ->get();
        //productdd($subcategory_name);
        return view('backend.products.edit')->with([
            'products' => $this->products,
            'category_list'=>$category_list,
            'subcategory_name'=>$subcategory_name
        ]);
    }
}