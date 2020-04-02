<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Category\Category;
use App\Models\Subcategory\Subcategory;
use App\Models\Product\variationMaster;
use App\Models\Product\productsVariations;
use App\Models\Product\variationValues;
use App\Models\Product\productImages;
use DB;
use Carbon\Carbon;
use Image;

class VariationController extends Controller
{
    public function index()
    {
        $productVariations=DB::table('variationmaster')
        ->leftjoin('variationvalues','variationmaster.id','=','variationvalues.variation_id')
        ->select('variationmaster.*',\DB::raw('GROUP_CONCAT(variationvalues.variation_value) as variationvalues'))
        ->groupBy('variationvalues.variation_id')->get();
        
        return view('backend.products.variations.show_variations')->with([
            'productvariation'=>$productVariations
        ]);
    }

    public function createVariation()   
    {
        return view('backend.products.variations.create_variation');
    }

    public function storeVariation(Request $request)
    {
        $input = $request->except(['_token']);
        
       $variation_master= DB::table('variationmaster')->insert([
            'variation_name'=>$input['variation_name'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        $variation_id=DB::table('variationmaster')
            ->select('id')
            ->where([
                ['variation_name','=',$input['variation_name']]
            ])->get();
        $variation_values=$input['variation_value'] ;
        $qry = '';
        foreach($variation_values as $value)
        {
            $qry .= "('$value', ".$variation_id[0]->id."),";
        }
        
        $finalQry;
        if($qry!='')
        {
            $qry = substr($qry, 0, -1);
            
            $finalQry = "INSERT INTO `variationvalues` (`variation_value`, `variation_id`) VALUES ".$qry;
            DB::unprepared($finalQry);
        }

        return redirect()->route('admin.variation.show');
    }

    public function editVariation($vid)
    {

        $variation_master = DB::table('variationmaster')
            ->leftjoin('variationvalues','variationmaster.id','=','variationvalues.     variation_id')
            ->select('variationmaster.id','variationmaster.variation_name','variationvalues.id as variation_value_id','variationvalues.variation_value')
            ->where('variationmaster.id','=',$vid)
            ->get();

        $product_variation_values = DB::table('productsvariations')
            ->select('productsvariations.variation_values_id')
            ->where('productsvariations.variation_id',$vid)->get();
        
        $product_variation= json_decode($product_variation_values[0]->variation_values_id);
                         
        return view('backend.products.variations.edit_variation')->with([
            'vdetails'=>$variation_master,
            'product_variation_values'=>$product_variation
        ]);
    }

    public function updateVariation(Request $request)
    {
        $input = $request->except(['_token']);
        DB::table('variationmaster')
            ->where('id','=',$input['variation_id'])
            ->update(['variation_name'=>$input['variation_name'],
                      'updated_at' =>Carbon::now()   
                    ]);
        $variation_value_id=$input['variation_value_id'];
            $variation_values=$input['variation_value'];
            $variation_delete_values=variationValues::whereIn('id',$variation_value_id)->delete();
        foreach($variation_values as $value)
            {
                if($value !=null){

                    DB::table('variationvalues')->insert([
                        'variation_value'=>$value,
                        'variation_id'=>$input['variation_id'],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                }
            }     
            return redirect()->route('admin.variation.show');
    }

    public function getValuesAjax(Request $request)
    {
        if($request->ajax())
        {

            $varid=$request->input('varid');
            $variationValues=variationValues::where('variation_id',$varid)->get();
            $response['data']=$variationValues;
            return json_encode($response);
        }
    }
}
