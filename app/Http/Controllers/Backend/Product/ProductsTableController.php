<?php

namespace App\Http\Controllers\Backend\Product;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Product\ProductRepository;
use App\Http\Requests\Backend\Product\ManageProductRequest;

/**
 * Class ProductsTableController.
 */
class ProductsTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var ProductRepository
     */
    protected $product;

    /**
     * contructor to initialize repository object
     * @param ProductRepository $product;
     */
    public function __construct(ProductRepository $product)
    {
        $this->product = $product;
    }

    /**
     * This method return the data of the model
     * @param ManageProductRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageProductRequest $request)
    {
    
        return Datatables::of($this->product->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($product) {
                return Carbon::parse($product->created_at)->toDateString();
            })
            ->addColumn('image',function($product){
                
                $url=url('storage/products/'.$product->image);

                return '<img src="'.$url.'" border="0" width="150" height="150" class="img-thumbnail" align="center" />';
            })
            ->addColumn('actions', function ($product) {
                return $product->action_buttons;
            })->filterColumn('Category', function ($query, $keyword) {
				$sql = "categories.category_name like ?";
				$query->whereRaw($sql, ["%{$keyword}%"]);
			})
            ->make(true);
    }
}
