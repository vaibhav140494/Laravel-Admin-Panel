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
      $final_data= parent::__construct();
        $all_category=$final_data[0];
        $all_subcategory=$final_data[1];
        $all_cart=$final_data[2];
        $wishlist=$final_data[3];

      // dd($all_category);
      $category=Category::paginate(6);
      for($i=0;$i<$category->count();$i++){
        $subcategory=Subcategory::where('category_id',$category[$i]->id)->get();
        $sub[$category[$i]->id] = $subcategory->count();
      }
      return view('frontend_user.category_list',compact('category','sub','all_category','all_subcategory','all_cart','wishlist'));
    }
    public function getAllCat(Request $request)
    {
        if($request->ajax())
        {
            $param= $request->input('str');
            $subcategory;
            if(($param!='') && (strlen($param)>=1))
            {
                $cat=Category::where('category_name','like','%'.$param.'%')
                ->get();;
                for($i=0;$i<$cat->count();$i++){
                    $subcategory=Subcategory::where('category_id',$cat[$i]->id)->get();
                    $sub[$cat[$i]->id] = $subcategory->count();
                  }
                if(count($cat)==0){
                $response['error'] ="sorry no sub category found";
                }
                else{
                    $response['sub']=$sub;
                    $response['success'] = true;
                    $response['data'] = $cat;
                }
                return json_encode($response);
            }
        }
        
    }
    
}
