<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Settings\Setting;
use App\Repositories\Frontend\Pages\PagesRepository;
use App\Models\Category\Category;
use App\Models\Order\Order;
use App\Models\Order\orderDetails;
use App\Models\Product\Product;
use App\Models\Subcategory\Subcategory;
use DB;
/**
 * Class FrontendController.
 */
class FrontendController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $product=Product::get()->keyBy('category_id');
       $count = DB::table('products')->selectRaw('products.category_id, count(products.id) as total')
        ->join('order_details','products.id','=','order_details.product_id')
        ->groupBy('order_details.product_id')
        ->orderBy('total','desc')->get();
        $max=0;
        $catarr=Array();
        for($i=0;$i<$count->count();$i++)
        {
            $catarr[$i]=$count[$i]->category_id;
            if($max<$count[$i]->total)
            {
                $max=$count[$i]->total;
                $catid=$count[$i]->category_id;   
            }   
        }
        $category_featured=Category::findMany($catarr);
        $category=Category::all();
        $featured_prod=Product::findMany($catarr);
        
        return view('frontend_user.index', compact('category_featured','category','product','featured_prod'));
    }

    /**
     * show page by $page_slug.
     */
    public function showPage($slug, PagesRepository $pages)
    {
        $result = $pages->findBySlug($slug);

        return view('frontend.pages.index')
            ->withpage($result);
    }
}
