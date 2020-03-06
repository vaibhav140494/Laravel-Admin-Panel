<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category\Category;
use App\Models\Subcategory\Subcategory;
use App\Models\Product\Product;
use App\Models\Product\variationMaster;
use App\Models\Product\variationValues;
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
                         
            // dd($var_array);
            $sort_product=DB::table('products')
            ->where('products.subcategory_id',$id)
            ->where('products.is_active',1)
            ->leftjoin('productreviews','products.id','=','productreviews.product_id')
            ->leftjoin('variationmaster','variationmaster.product_id','products.id')
            ->leftjoin('variationvalues','variationvalues.variation_id','variationmaster.id');
            
            if($var_array!=null){
                foreach($var_array as $k){
                    
                    if($k['name']=='Size')
                    {
                        $sort_product=$sort_product
                        
                        ->orWhere('variationvalues.variation_value',$k['value']);
                    }
                    if($k['name']=='Resolution')
                    {
                        
                        $sort_product=$sort_product
                    
                        ->where('variationvalues.variation_value',$k['value']);
                    }
                    if($k['name']=='rating')
                    {
                        $sort_product=$sort_product->where('rating','>=',$k['value']);
                    }
                    if($k['name']=='exclude')
                    {
                        $sort_product=$sort_product->where('products.quantity','>',0);
                    }
                } 
            }

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
            if($value=='rating')
            {
                $sort_product=$sort_product->orderBy('rating','desc');
            }
            
            $sort_product=$sort_product->groupBy('products.id')
            ->select('products.*',\DB::raw('avg(productreviews.rating) as rating'))->get();

            // dd($sort_product);

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
            $response['data']=$sort_product;
            return json_encode($response);
        }
        // For fetching subcategories wise product variation

        $parr=array();
        $product_var=Product::where('subcategory_id',$id)->get();
        for($i=0;$i<$product_var->count();$i++){
            $parr[$i]=$product_var[$i]->id;
        }
        
        $product_var= variationMaster::with('variationValues')->whereIn('product_id',[$parr])->get();
        // dd($parr);
        // $product_var= DB::table('products')
        // ->leftjoin('variationmaster','variationmaster.product_id','=','products.id')
        // ->leftjoin('variationvalues','variationvalues.variation_id','=','variationmaster.id')
        // ->whereIn('products.id',[$parr])->get();
       
        // dd($product_var);
       
        return view('frontend_user.products_list',compact('prod','subcategory','category','all_category','all_subcategory','all_cart','wished_prod','category_featured','all_products','wishlist','cart_item','product_var'));
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
            // dd($product_variation_values[1]);
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
        foreach($related_products as $p)
        {
        
           $img = DB::table('productimages')
                                  ->where('product_id',$p->id)
                                  ->pluck('product_image')->toArray();
                                  //dd($img->product_image);
            $p->other=$img;                 
        }
       // dd($related_products);
        $avg=$product_review_avg=productReviews::where('product_id',$id)->get()->avg('rating');
        
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
        $sort_product=DB::table('products')
            ->where('products.subcategory_id',$id)
            ->where('is_active',1)
            ->leftjoin('productreviews','products.id','=','productreviews.product_id')
            ->groupBy('products.id')
            ->select('products.*',\DB::raw('avg(productreviews.rating) as rating'));

    }

}

