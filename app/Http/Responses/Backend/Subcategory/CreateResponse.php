<?php

namespace App\Http\Responses\Backend\Subcategory;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category\Category;



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
    {
        $categories = Category::all();
        // dd($categories[0]->category_name);
        return view('backend.subcategories.create')->with(['categories'=>$categories]);
    }
}