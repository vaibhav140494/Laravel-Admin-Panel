<?php

namespace App\Http\Controllers\Backend\Product;

use App\Models\Product\Product;
use App\Models\Category\Category;
use App\Models\Subcategory\Subcategory;
use App\Models\Product\variationMaster;
use App\Models\Product\variationValues;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
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
        //dd($input);
        if ($request->hasFile('image')){
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            //dd($imageName);
        $path = $request->image->move(public_path('storage/products'), $imageName);
            
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
        $path = $request->image->move(public_path('storage/products'), $imageName);
            
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
        $product_name=DB::table('products')
                    ->select('product_name as pname')
                    ->where('id','=',$request['id'])
                    ->get();
                   //dd($product_name);
        
                    //dd($variation_nameid);
        $var=DB::table('variationmaster')
                ->join('variationvalues', 'variationmaster.id', '=', 'variationvalues.variation_id')
                ->select('variationmaster.variation_name as VariationName','variationmaster.id as id',DB::raw("(GROUP_CONCAT(variationvalues.variation_value SEPARATOR ',')) as `Variationvalues`"))
                ->where('variationmaster.product_id','=',$request['id'])
                ->groupBy('variationmaster.id')
                ->paginate(1);
               // dd($var);
                
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
        //dd($product_id);
        DB::table('variationmaster')->insert([
            'variation_name'=>$input['variation_name'],
            'product_id'=>$product_id[0]->id
        ]);
        $variation_id=DB::table('variationmaster')
                     ->select('id')
                     ->where([
                         ['product_id','=',$product_id[0]->id],
                         ['variation_name','=',$input['variation_name']]
                     ])->get();
        $variation_values=$input['variation_value'] ;
        foreach($variation_values as $value)
        {
            DB::table('variationvalues')->insert([
                'variation_value'=>$value,
                'variation_id'=>$variation_id[0]->id
            ]);
        }  
        return redirect()->route('admin.products.productvariations.show',['id'=>$product_id[0]->id]);
    }
}
