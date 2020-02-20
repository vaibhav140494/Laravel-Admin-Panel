<?php

namespace App\Http\Controllers\Backend\Product;

use App\Models\Product\Product;
use App\Models\Category\Category;
use App\Models\Subcategory\Subcategory;
use App\Models\Product\variationMaster;
use App\Models\Product\variationValues;
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
        //dd($request['id']);
        $pid=$request['id'];
        $product_name = DB::table('products')
                    ->select('product_name as pname')
                    ->where('id','=',$request['id'])
                    ->get();
                    
        $var = DB::table('variationmaster')
                ->join('variationvalues', 'variationmaster.id', '=', 'variationvalues.variation_id')
                ->select('variationmaster.variation_name as VariationName','variationmaster.id as id',DB::raw("(GROUP_CONCAT(variationvalues.variation_value SEPARATOR ',')) as `Variationvalues`"))
                ->where('variationmaster.product_id','=',$request['id'])
                ->groupBy('variationmaster.id')
                ->get();
            //    dd($var);
                
        return view('backend.products.productvariation')->with([
            'data' => $var,
            'name' => $product_name,
            'productid'=>$pid
        ]);
    }

    public function deleteVariation(Request  $request)
    {
        //dd($request['id']);
        
        DB::table('variationmaster')->where('id','=',$request['id'])->delete();
        return redirect()->back();
        //return view('backend.products.productvariation');
    }
    public function createVariation(Request $request)
    {
        $productdetails=DB::table('products')
                    ->select('product_name','category_id','subcategory_id')
                    ->where('id','=',$request['id'])
                    ->get(); 
                    //dd( $productdetails);
        $subcategory_name=DB::table('subcategories') 
                            ->select('subcategory_name')
                            ->where('id','=',$productdetails[0]->subcategory_id)
                            ->get();
                       // dd($subcategory_name);
        $category_name=DB::table('categories') 
                            ->select('category_name')
                            ->where('id','=',$productdetails[0]->category_id)
                            ->get();
        return view('backend.products.createVariation')->with([
            'pname'=>$productdetails[0]->product_name,
            'cname'=>$category_name[0]->category_name,
            'sname'=>$subcategory_name[0]->subcategory_name
        ]);
    }
    public function storeVariation(Request $request)
    {
        $input = $request->except(['_token']);
        
        $product_id=DB::table('products')
                    ->select('id')
                    ->where('product_name','=',$input['product_name'])
                    ->get();
        
        DB::table('variationmaster')->insert([
            'variation_name'=>$input['variation_name'],
            'product_id'=>$product_id[0]->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        $variation_id=DB::table('variationmaster')
                     ->select('id')
                     ->where([
                         ['product_id','=',$product_id[0]->id],
                         ['variation_name','=',$input['variation_name']]
                     ])->get();
        $variation_values=$input['variation_value'] ;
        $qry = '';
        
        foreach($variation_values as $value)
        {
            $qry .= "('$value', ".$variation_id[0]->id."),";
        }
        

        if($qry!='')
        {
            $qry = substr($qry, 0, -1);
            
            $finalQry = "INSERT INTO `variationvalues` (`variation_value`, `variation_id`) VALUES ".$qry;
            DB::unprepared($finalQry);
            // dd($finalQry);
        }
        return redirect()->route('admin.products.productvariations.show',['id'=>$product_id[0]->id]);
    }
    public function editVariation($vid,$pid)
    {
        //dd($pid);
        $product_details=DB::table('products')
                    ->select('id','product_name')
                    ->where('id','=',$pid)
                    ->get();
        //dd($product_name);
        $variation_details=DB::table('variationmaster')
                          ->select('id','variation_name')
                          ->where('id','=',$vid)
                          ->get();
        $variation_values=DB::table('variationvalues')
                            ->select('variation_value')
                            ->where('variation_id','=',$vid)
                            ->get();                  
        //dd($variation_values);
            return view('backend.products.editVariation')->with([
                'pdetails'=>$product_details,
                'vdetails'=>$variation_details,
                'values'=>$variation_values
            ]);
    }
    public function updateVariation(Request $request)
    {
        $input = $request->except(['_token']);
       // dd($input);
        $product_id=DB::table('products')
                    ->select('id')
                    ->where('product_name','=',$input['product_name'])
                    ->get();
        DB::table('variationmaster')
            ->where('id','=',$input['variation_id'])
            ->update(['variation_name'=>$input['variation_name'],
                      'updated_at' => Carbon::now()   
                    ]);
         DB::table('variationvalues')->where('variation_id','=',$input['variation_id'])->delete();   
        $variation_values=$input['variation_value'] ;
        foreach($variation_values as $value)
            {
                DB::table('variationvalues')->insert([
                    'variation_value'=>$value,
                    'variation_id'=>$input['variation_id'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }     
            return redirect()->route('admin.products.productvariations.show',['id'=>$product_id[0]->id]);
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
        //dd($input);
        $count=0;
        $imageName=array();
        if($request->hasFile('images'))
        {
            foreach($input['images'] as $image)
            {
                $name=time().$count.'.'.$image->getClientOriginalExtension();
                $image->move(public_path('storage/productimages'), $name);
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
        return view('backend.products.index');
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
