<?php

namespace App\Repositories\Backend\Subcategory;

use DB;
use Carbon\Carbon;
use App\Models\Subcategory\Subcategory;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubcategoryRepository.
 */
class SubcategoryRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Subcategory::class;

    /**
     * This method is used by Table Controller
     * For getting the table data to show in
     * the grid
     * @return mixed
     */
    public function getForDataTable($id)
    {
        return $this->query()->where('category_id',$id)
            ->select([
                config('module.subcategories.table').'.id',
                config('module.subcategories.table').'.subcategory_name',
                config('module.subcategories.table').'.subcategory_desc',
                config('module.subcategories.table').'.category_id',
                config('module.subcategories.table').'.is_active',
                config('module.subcategories.table').'.created_at',
                config('module.subcategories.table').'.updated_at',
            ]);
    }

    /**
     * For Creating the respective model in storage
     *
     * @param array $input
     * @throws GeneralException
     * @return bool
     */
    public function create(array $input)
    {
        
        // dd($input);
        if (Subcategory::create($input)) {
            
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.subcategories.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param Subcategory $subcategory
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(Subcategory $subcategory, array $input)
    {
    	if ($subcategory->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.subcategories.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param Subcategory $subcategory
     * @throws GeneralException
     * @return bool
     */
    public function delete(Subcategory $subcategory)
    {
        if ($subcategory->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.subcategories.delete_error'));
    }
}
