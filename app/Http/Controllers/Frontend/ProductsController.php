<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category\Category;
use App\Models\Subcategory\Subcategory;
use App\Models\Product\Product;
use App\Models\Product\variationMaster;
use App\Models\Product\variationValues;
use App\Models\Product\productsVariations;
use App\Models\Order\wishList;
use App\Models\Product\productReviews;
use DB;
use Carbon\Carbon;


class ProductsController extends Controller
{
    public function __construct()
    {
        parent::__construct();

    }
    //Get all product based on subcategory
    
    public function getProd($id,$cid,Request $request)
    {
        $all_category = $this->final_data[0];
        $all_subcategory = $this->final_data[1];
        $all_cart = $this->final_data[2];
        $category_featured = $this->final_data[3];
        $all_products = $this->final_data[5];
        $wishlist = $this->final_data[4];
        $catarr = $this->catarr;
        $cart_item=$this->final_data[6];
        $wished_prod=$this->final_data[7];
        $subcategory = Subcategory::find($id);
        
        $category = Category::find($cid);
        
        $prod = DB::table('products')
        ->where('products.subcategory_id',$id)
        ->where('is_active',1)
        ->leftjoin('productreviews','products.id','=','productreviews.product_id')
        ->groupBy('products.id')
        ->select('products.*',\DB::raw('avg(productreviews.rating) as rating'))->orderBy('products.price')->orderBy('products.created_at','desc')->get();
        if($request->ajax() !=null)
        {
            $value=$request->input('value');

            $var_array = $request->input('varname');
            $var_value=$request->input('varvalue');
            $id_arr= array();
            $id_arr_value= array();
            $i=0;

            if(isset($var_value)){
                
                foreach($var_value as $vvalue)
                {
                    $str= $vvalue;
                    $strid=explode('_',$str);
                    $id_arr[$i]=$strid[2];
                    if(isset($id_arr_value[$strid[2]]))
                    {
                        $id_arr_value[$strid[2]][$i] = $strid[1];
                    }
                    else{
                        $id_arr_value[$strid[2]]=array();
                        $id_arr_value[$strid[2]][$i] = $strid[1];
                    }
                    $i++;
                }
            }
            // dd($id_arr_value);
            $sort_product=DB::table('products')
            ->where('products.subcategory_id',$id)
            ->where('products.is_active',1)
            ->leftjoin('productreviews','products.id','=','productreviews.product_id')
            ->leftjoin('productsvariations','productsvariations.product_id','products.id')
            ->leftjoin('variationvalues','variationvalues.variation_id','productsvariations.variation_id');

            if($value=='price-desc')
            {
                $sort_product=$sort_product->orderBy('products.price','desc');
            }
            else if($value=='price-asc')
            {
                $sort_product=$sort_product->orderBy('products.price');
            }
            else if($value=='name-asc')
            {
                $sort_product=$sort_product->orderBy('products.product_name');
            }
            else if($value=='name-desc')
            {
                $sort_product=$sort_product->orderBy('products.product_name','desc');
            }
            else if($value=='latest')
            {
                $sort_product=$sort_product->orderBy('products.created_at','desc');
            }
            if($value == 'rating')
            {
                $sort_product=$sort_product->orderBy('rating','desc');
            }
            if($id_arr_value){

                foreach($id_arr_value as $id)
                {
                    // dd($id);
                    $sort_product = $sort_product->orWhere(function($qry) use($id){
                        $qry = $qry->whereIn('variationvalues.variation_value',$id);
                    });
                }
                // dd($sort_product->toSql());
                
            }
            
            if($var_array!=null){
                foreach($var_array as $k){

                    if($k['name']=='exclude')
                    {
                        if($k['value']=='on'){
                           $sort_product=$sort_product->where('products.quantity','>',0);
                        }
                    }
                     if($k['value']=='price-desc')
                    {
                        $sort_product=$sort_product->orderBy('products.price','desc');
                    }
                    else if($k['value']=='price-asc')
                    {
                        $sort_product=$sort_product->orderBy('products.price');
                    }
                    else if($k['value']=='name-asc')
                    {
                        $sort_product=$sort_product->orderBy('products.product_name');
                    }
                    else if($k['value']=='name-desc')
                    {
                        $sort_product=$sort_product->orderBy('products.product_name','desc');
                    }
                    else if($k['value']=='latest')
                    {
                        $sort_product=$sort_product->orderBy('products.created_at','desc');
                    }
                    if($k['value']=='rating')
                    {
                        $sort_product=$sort_product->orderBy('rating','desc');
                    }
                    if($k['name']=='rating')
                    {
                        $sort_product=$sort_product->where('rating','>=',$k['value']);
                    }
                    if($k['name']=='range')
                    {   
                        $sort_product=$sort_product->whereBetween('price',[$k['value']]);
                    }
                } 
            }

            $sort_product = $sort_product->groupBy('products.id')
            ->select('products.*',\DB::raw('avg(productreviews.rating) as rating'))->get();

            foreach($sort_product as $pr){
                if(isset($cart_item)){
                    if(in_array($pr->id,$cart_item))
                        $response['cart '.$pr->id]=true;
                }
                if(isset($wished_prod)){
                    if(in_array($pr->id,$wished_prod))
                        $response['wish '.$pr->id]=true;
                }
            }
            $response['data'] = $sort_product;
            return json_encode($response);
        }
        // For fetching subcategories wise product variation

        $parr=array();
        $product_var=Product::where('subcategory_id',$id)->get();
        for($i=0;$i<$product_var->count();$i++){
            $parr[$i]=$product_var[$i]->id;
        }
        
        //for fetching product variations
        $product_variations=DB::table('productsvariations')
            ->leftjoin('variationmaster','productsvariations.variation_id','=','variationmaster.id')
            ->whereIn('product_id',$parr)
            ->select('productsvariations.variation_id','variationmaster.variation_name','variation_values_id',DB::raw('GROUP_CONCAT(variation_values_id) as variaitions'))
            ->groupBy('variation_name')
            ->get();

        foreach($product_variations as $key => $value)
        {
            $vararray=explode('"',$value->variaitions);
            
            $product_variations[$key]->variation_values = variationValues::whereIn('id', $vararray)
            ->select('id','variation_value')->get(); 
        }
        
        return view('frontend_user.products_list',compact('prod','subcategory','category','all_category','all_subcategory','all_cart','wished_prod','category_featured','all_products','wishlist','cart_item','product_var','variation','product_variations'));
    }

    // get  product details 
    public function detailProd($id,$subid,$cid)
    {   
        $all_category = $this->final_data[0];
        $all_subcategory = $this->final_data[1];
        $all_cart = $this->final_data[2];
        $category_featured = $this->final_data[3];
        $all_products = $this->final_data[5];
        $wishlist = $this->final_data[4];
        $wished_prod=$this->final_data[7];

        $catarr = $this->catarr;
        $category = Category::find($cid);
        $subcategory = Subcategory::find($subid);
        $product = DB::table('products')->leftjoin('productreviews','products.id','=','productreviews.product_id')
        ->where('products.id',$id)
        ->select('products.*','productreviews.product_id','productreviews.user_id','productreviews.rating','productreviews.review',\DB::raw("ROUND(AVG(rating),2) as avg_rating",'category_featured'))
        ->get()->first();

        $product_variation=array();

        $product_variation_values=array();
        if($product->type==2)
        {
            $product_variation = variationMaster::where('product_id',$product->id)->get();
            foreach($product_variation as $pv)
            {
                $product_variation_values[$pv->id]= variationValues::where('variation_id',$pv->id)->get();
            }
        }

        $count_reviews = productReviews::selectRaw("count(*) as count")->where('product_id',$id)->get()->toArray();

        $users_product_reviews = DB::table('users')
        ->leftjoin('productreviews','users.id','=','productreviews.user_id')
        ->select('users.*','productreviews.product_id','productreviews.user_id','productreviews.rating','productreviews.review','productreviews.review_date')
        ->where('productreviews.product_id',$id)
        ->orderBy('productreviews.rating','desc')->limit(4)->get();
       
        $related_products = DB::table('products')->
        leftjoin('productreviews','products.id','=','productreviews.product_id')->select('products.*','productreviews.product_id','productreviews.user_id','productreviews.rating','productreviews.review')
        ->where('products.category_id',$cid)
        ->where('products.id','<>',$id)
        ->orderBy('rating','desc')->get()->keyBy('subcategory_id');

        $avg=$product_review_avg = productReviews::where('product_id',$id)->get()->avg('rating');
        
        return view('frontend_user.product-details',compact('product','users_product_reviews','category','subcategory','related_products','count_reviews','all_category','all_subcategory','all_cart','wished_prod','category_featured','all_products','wishlist','product_variation','product_variation_values'));
    }

    //For store product review using ajax

    public function storeReview(Request $req)
    {
        if($req->ajax())
        {
             $id = $req->input('pid');
             $rating = $req->input('rating');
             $review = $req->input('review');
             $preview = new productReviews;
             $preview->user_id = \Auth::user()->id;
             $preview->product_id = $id;
             $preview->rating = $rating;
             $preview->review = $review;
             $preview->review_date = date('Y-m-d');
             if($preview->save())
             {
                 echo "success";
             }
             else
             echo "fail";
             
        }
    }

    public function filterProduct(Request $request)
    {
        $var_array = $request->input('varname');
        $exclude = $request->input('exclude');
        $sort_product = DB::table('products')
            ->where('products.subcategory_id',$id)
            ->where('is_active',1)
            ->leftjoin('productreviews','products.id','=','productreviews.product_id')
            ->groupBy('products.id')
            ->select('products.*',\DB::raw('avg(productreviews.rating) as rating'));

    }

}

