<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category\Category;
use App\Models\Subcategory\Subcategory;

class SubcategoriesController extends Controller
{
    public function getSub($id)
    {
        // dd("hello");
        $final_data= parent::__construct();
        $all_category=$final_data[0];
        $all_subcategory=$final_data[1];
        $all_cart=$final_data[2];
        $wishlist=$final_data[3];

        $categories=Category::find($id);
        $subcategory=Subcategory::where('category_id',$id)->get();
        // dd($category->category_name);
        return view('frontend_user.subcategory-list',compact('categories','subcategory','all_category','all_subcategory','all_cart','wishlist'));
    }
    public function getAll(Request $request)
    {
        if($request->ajax())
        {
            $param= $request->input('str');
            $id=$request->input('id');
            if(($param!='') && (strlen($param)>=1))
            {
                $sub=Subcategory::where('subcategory_name','like','%'.$param.'%')->where('category_id',$id)
                ->get()->toArray();
                if(count($sub)==0){
                $response['error'] ="sorry no sub category found";
                }
                else{
                    $response['success'] = true;
                    $response['data'] = $sub;
                }
                return json_encode($response);
            }
            
        }
    }

}
