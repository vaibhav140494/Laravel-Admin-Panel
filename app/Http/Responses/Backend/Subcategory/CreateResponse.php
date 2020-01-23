<?php

namespace App\Http\Responses\Backend\Subcategory;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category\Category;
use App\Models\Subcategory\Subcategory;



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
        // dd($id);
        // dd($request->get('category_id'));
        $categories = Category::where('is_active',1)->get();
        // dd($categories[0]->category_name);
        return view('backend.subcategories.create')->with(['categories'=>$categories]);
    }
}