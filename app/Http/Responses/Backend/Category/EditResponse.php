<?php

namespace App\Http\Responses\Backend\Category;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Category\Category
     */
    protected $categories;

    /**
     * @param App\Models\Category\Category $categories
     */
    public function __construct($categories)
    {
        $this->categories = $categories;
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
        
        return view('backend.categories.edit')->with([
            'categories' => $this->categories
        ]);
    }
}