<?php

namespace App\Repositories\Backend\Product;

use DB;
use Carbon\Carbon;
use App\Models\Product\Product;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductRepository.
 */
class ProductRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Product::class;

    /**
     * This method is used by Table Controller
     * For getting the table data to show in
     * the grid
     * @return mixed
     */
    public function getForDataTable()
    {
        //dd("hello");
        $product = $this->query()
                 ->leftjoin('categories','categories.id','=','products.category_id')
                 ->leftjoin('subcategories','subcategories.id','=','products.subcategory_id')
            ->select([
                config('module.products.table').'.id',
                'categories.category_name as category',
                'subcategories.subcategory_name as subcategory',
                config('module.products.table').'.sku',
                config('module.products.table').'.product_name',
                config('module.products.table').'.quantity',
                config('module.products.table').'.type',
                config('module.products.table').'.price',
                config('module.products.table').'.discouted_price',
                config('module.products.table').'.image',
                config('module.products.table').'.specification',
                config('module.products.table').'.created_at',
                config('module.products.table').'.updated_at',
            ])->where('products.is_active',1);
            //dd($product);
            return $product;
    }

    /**
     * For Creating the respective model in storage
     *
     * @param array $input
     * @throws GeneralException
     * @return bool
     */
    public function create(array $input)
    {   //dd($input);
        if (Product::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.products.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param Product $product
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(Product $product, array $input)
    {
    	if ($product->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.products.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param Product $product
     * @throws GeneralException
     * @return bool
     */
    public function delete(Product $product)
    {
        if ($product->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.products.delete_error'));
    }
}
