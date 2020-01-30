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
      $category=Category::paginate(6);
      for($i=0;$i<$category->count();$i++){
        $subcategory=Subcategory::where('category_id',$category[$i]->id)->get();
        $sub[$category[$i]->id] = $subcategory->count();
      }
      return view('frontend_user.category_list',compact('category','sub'));
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
                // $sub=Subcategory::find($cat->id);
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
