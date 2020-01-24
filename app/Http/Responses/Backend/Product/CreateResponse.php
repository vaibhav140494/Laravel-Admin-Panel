<?php

namespace App\Http\Responses\Backend\Product;

use Illuminate\Contracts\Support\Responsable;
use App\Models\Category\Category;
use DB;

class CreateResponse implements Responsable
{
    /**
     * To Response
     *
     * @param \App\Http\Requests\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {   $category_list=DB::table('categories')
        ->select('id','category_name')
        ->get();
        return view('backend.products.create')->with('category_list',$category_list);
    }
}