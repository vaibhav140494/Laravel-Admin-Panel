<?php

namespace App\Http\Controllers\Backend\Product;

use App\Models\Product\Product;
use App\Models\Category\Category;
use App\Models\Subcategory\Subcategory;
use App\Models\Product\variationMaster;
use App\Models\Product\variationValues;
use App\Models\Product\productsVariations;
use App\Models\Product\productImages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use Carbon\Carbon;
use Image;
use App\Http\Responses\Backend\Product\CreateResponse;
use App\Http\Responses\Backend\Product\EditResponse;
use App\Repositories\Backend\Product\ProductRepository;
use App\Http\Requests\Backend\Product\ManageProductRequest;
use App\Http\Requests\Backend\Product\CreateProductRequest;
use App\Http\Requests\Backend\Product\StoreProductRequest;
use App\Http\Requests\Backend\Product\EditProductRequest;
use App\Http\Requests\Backend\Product\UpdateProductRequest;
use App\Http\Requests\Backend\Product\DeleteProductRequest;
use DB;

/**
 * ProductsController
 */
class ProductsController extends Controller
{
    /**
     * variable to store the repository object
     * @var ProductRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param ProductRepository $repository;
     */
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\Product\ManageProductRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageProductRequest $request)
    {
        
        return new ViewResponse('backend.products.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateProductRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Product\CreateResponse
     */
    public function create(CreateProductRequest $request)
    {
        
        return new CreateResponse('backend.products.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreProductRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreProductRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);

        if ($request->hasFile('image')){
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $img=Image::make($request->image);
            $img->fit(400,300);
            $var=public_path('storage/products');
            $path = $img->save($var."/".$imageName);
            
        }
        
        $input['image']=$imageName; 
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.products.index'), ['flash_success' => trans('alerts.backend.products.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Product\Product  $product
     * @param  EditProductRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Product\EditResponse
     */
    public function edit(Product $product, EditProductRequest $request)
    {
        return new EditResponse($product);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProductRequestNamespace  $request
     * @param  App\Models\Product\Product  $product
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        if($request->file('image')){
            if ($request->hasFile('image')){
                $imageName = time().'.'.$request->image->getClientOriginalExtension();
                //dd($imageName);
                $img=Image::make($request->image);
                $img->fit(400,300);
                $var=public_path('storage/products');
                $path = $img->save($var."/".$imageName);
            //$path = $request->image->move(public_path('storage/products'), $imageName);
            }
            $input['image']=$imageName; 
        }
        $this->repository->update( $product, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.products.index'), ['flash_success' => trans('alerts.backend.products.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteProductRequestNamespace  $request
     * @param  App\Models\Product\Product  $product
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Product $product, DeleteProductRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($product);
        //returning with successfull message
        return new RedirectResponse(route('admin.products.index'), ['flash_success' => trans('alerts.backend.products.deleted')]);
    }
    public function getSubCategories(Request $request)
    {
        if($request->ajax())
        {
            $category_id=$request->input('id');
            $subcategories=DB::table('subcategories')
                               ->where('category_id',$category_id)
                               ->get();
            $subcat = json_encode($subcategories);
            return $subcat;                   
        }
    }
    public function getProductVariations(Request $request,$id)
    {
        
        $product_name = DB::table('products')
            ->select('product_name as pname')
            ->where('id','=',$id)
            ->get();
                
        $product_variation_values=DB::table('productsvariations')
        ->where('product_id',$id)->select('variation_id','variation_values_id')->get();
        $varvalue_array=array();
        $product_variations;
        // dd($product_variation_values);
        $all_variations=array();
        $i=0;
        if(isset($product_variation_values)){
            
            foreach($product_variation_values as $pv_value)
            {
                
                $product_variations = DB::table('productsvariations')
                ->leftjoin('variationmaster','variationmaster.id','=','productsvariations.variation_id')
                ->leftjoin('variationvalues','variationmaster.id','=','variationvalues.variation_id')
                ->where('productsvariations.product_id',$id);

                $varvalue_array[$pv_value->variation_id] = $pv_value->variation_values_id;
                $value = json_decode($varvalue_array[$pv_value->variation_id]);

                $product_variations = $product_variations->whereIn('variationvalues.id',$value)
                    ->select(\DB::raw('GROUP_CONCAT(variationvalues.variation_value) as variationvalues'),'variationmaster.variation_name','variationmaster.id')
                    ->groupBy('productsvariations.variation_id')->get();
                $all_variations[$i++]=$product_variations;
            }
        }
        return view('backend.products.productvariation')->with([
            'productvariation'=>$all_variations,
            'product_id' => $id
        ]);
    }

    public function deleteVariation(Request  $request)
    {
        //dd($request['id']);
        $pid = $request['pid'];
        DB::table('variationmaster')->where('id','=',$request['id'])->delete();
        //return redirect()->back();
        //return view('backend.products.productvariation');
        return new RedirectResponse(route('admin.products.productvariations.show',['id'=>$pid]), ['flash_success' => trans('variation is deleted')]);
    }
    public function createVariation(Request $request,$id)
    {
        $request['id']=$id; 
        //if($request['id'] !=null){
            $productdetails=DB::table('products')
                ->leftjoin('subcategories','subcategories.id','=','products.subcategory_id')
                ->leftjoin('categories','categories.id','=','products.category_id')
                ->select('product_name','products.id','products.category_id','subcategory_id','subcategory_name','category_name')
                ->where('products.id','=',$request['id'])
                ->get()->first(); 
            
            $variations = DB::table('variationmaster')
            ->leftjoin('variationvalues','variationmaster.id','=','variationvalues.variation_id')
            ->select('variationmaster.*',\DB::raw('GROUP_CONCAT(variationvalues.variation_value) as variationvalues'))
            ->groupBy('variationvalues.variation_id')->get();
            
            return view('backend.products.createVariation')->with([
                'productdetails'=> $productdetails,
                'variations'=>$variations
            ]);
       // }
        // else
        // {
        //     return view('backend.products.createVariation');
        // }
    }
    public function storeVariation(Request $request)
    {
        $input = $request->except(['_token']);
        $product_id = $input['product_id'];
        $var_values = json_encode($input['variation_value_id']);
        $productVariations = new productsVariations;
        $productVariations->product_id = $input['product_id'];
        $productVariations->variation_id = $input['variation_id'];
        $productVariations->variation_values_id = $var_values;
        // $productVariations->save();
        $productVariations->save();
        // dd(json_decode($var_values));
        // dd($productVariations);
        // $product_id=DB::table('products')
        //             ->select('id')
        //             ->where('product_name','=',$input['product_name'])
        //             ->get();
        
        // $variationmaster=new variationMaster;
        // $variationmaster->variation_name=$input['variation_id'];
        // $variationmaster->save();
        // dd($variationmaster);
        // DB::table('variationmaster')->insert([
        //     'variation_name'=>$input['variation_name'],
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()
        // ]);

        // $variation_id=DB::table('variationmaster')
        //              ->select('id')
        //              ->where([
        //                  ['product_id','=',$product_id[0]->id],
        //                  ['variation_name','=',$input['variation_name']]
        //              ])->get();
        // $variation_values=$input['variation_value'] ;
        // $qry = '';
        
        // foreach($variation_values as $value)
        // {
        //     $qry .= "('$value', ".$variation_id[0]->id."),";
        // }

        // if($qry!='')
        // {
        //     $qry = substr($qry, 0, -1);
            
            $finalQry = "INSERT INTO `variationvalues` (`variation_value`, `variation_id`) VALUES ".$qry;
            DB::unprepared($finalQry);
            // dd($finalQry);
        //return redirect()->route('admin.products.productvariations.show',['id'=>$product_id[0]->id]);
        return new RedirectResponse(route('admin.products.productvariations.show',['id'=>$product_id[0]->id]), ['flash_success' => trans('variation is created')]);
    }
    public function editVariation($vid,$pid)
    {
        // dd($pid);
        $product_details=DB::table('products')
            ->leftjoin('productsvariations','productsvariations.product_id','products.id')
            ->leftjoin('variationmaster','variationmaster.id','productsvariations.variation_id')
            ->select('products.id as product_id','products.product_name','productsvariations.id as product_variation_id','variationmaster.id as variation_id','variationmaster.variation_name','variation_values_id')
            ->where('products.id','=',$pid)
            ->where('productsvariations.variation_id','=',$vid)
            ->get();
        
        // $vararray=json_decode($product_details[0]->variation_values_id);
        $variation_details=DB::table('variationvalues')
            ->select('id','variation_value')
            ->where('variation_id',$vid)
            ->get();
        $variation_values =variationValues::where('variation_id',$vid)->get();
            return view('backend.products.editVariation')->with([
                'pdetails'=>$product_details,
                'values'=>$variation_details
            ]);
    }
    public function updateVariation(Request $request)
    {

        $input = $request->except(['_token']);
        $product_id = $input['product_id'];
        $var_values = json_encode($input['variation_value_id']);
        $productVariations = productsVariations::find($input['product_variation_id']);
        $productVariations->product_id = $input['product_id'];
        $productVariations->variation_id = $input['variation_id'];
        $productVariations->variation_values_id = $var_values;
        $productVariations->save();
    
        // return redirect()->route('admin.products.productvariations.show',[$product_id]);
        return new RedirectResponse(route('admin.products.productvariations.show',['id'=>$product_id]), ['flash_success' => trans('variation is updated')]);

    }

    public function uploadProductImages(Request $request,$id)
    {
        $input = $request->except(['_token']);
        //
       // dd($id);
       $product_details=DB::table('products')
                    ->select('id','product_name')
                    ->where('id','=',$id)
                    ->get();
        return view('backend.products.addProductImages')->with([
            'pdetails'=>$product_details
        ]);            
    }
    public function storeProductImages(Request $request)
    {
        $input = $request->except(['_token']);
        $count=0;
        $imageName=array();
        if($input['images'])
        {
            foreach($input['images'] as $image)
            {
                $name=time().$count.'.'.$image->getClientOriginalExtension();
                //dd($name);
                $img=Image::make($image);
                $img->fit(400,300);
                $var=public_path('storage/productimages');
                $path = $img->save($var."/".$name);
                //$image->move(public_path('storage/productimages'), $name);
                $imageName[]=$name;
                $count++;
            }
        }
        //dd($imageName);
        foreach($imageName as $image)
        {
            DB::table('productimages')->insert([
                'product_id'=>$input['product_id'],
                'product_image'=>$image,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]);
        }
       // return view('backend.products.index');
        return new RedirectResponse(route('admin.products.index'), ['flash_success' => trans('products images are added')]);
    }
    public function productGalary($id)
    {
        //dd($id);
        $images=DB::table('productimages')
                   ->select('id','product_image')
                   ->where('product_id','=',$id)
                   ->get();
                   //dd($images);
        return view('backend.products.productGalary')->with([
            'images'=>$images,
            'productid'=>$id
        ]);            
    }
    public function deleteProductImage(Request $request)
    {
        
        $id=$request->input('id');
        //dd($id);
        
        DB::table('productimages')->where('id','=',$id)->delete();
        
        return 1;
        
    }
}
