<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category\Category;
use App\Models\Subcategory\Subcategory;
use App\Models\Product\Product;


class CategoriesController extends Controller
{
    public function index()
    {
      $category=Category::all();
      for($i=0;$i<$category->count();$i++){
        $subcategory=Subcategory::where('category_id',$category[$i]->id)->get();
        $sub[$category[$i]->id] = $subcategory->count();
      }
      return view('frontend_user.category_list',compact('category','sub'));
    }
    public function getSub($id)
    {
        $category=Category::find($id);
        $subcategory=Subcategory::where('category_id',$id)->get();
        // dd($subcategory[0]->subcategory_name);
        return view('frontend_user.subcategory-list',compact('category','subcategory'));
    }
    public function getProd($id)
    {
        $subcategory=Subcategory::find($id);
        // dd($subcategory);
        $prod=Product::where('subcategory_id',$subcategory->id)->get();
        return view('frontend_user.subcategory-list',compact('category','subcategory'));
    }
}
