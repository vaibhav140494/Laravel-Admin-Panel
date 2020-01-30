<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category\Category;
use App\Models\Subcategory\Subcategory;
use App\Models\Product\Product;

class ProductsController extends Controller
{
    public function getProd($id)
    {
        $subcategory=Subcategory::find($id);
        // dd($subcategory);
        $prod=Product::where('subcategory_id',$subcategory->id)->get();
        return view('frontend_user.products_list',compact('prod','subcategory'));
    }
}
