<?php

namespace App\Repositories\Backend\Category;

use DB;
use Carbon\Carbon;
use App\Models\Category\Category;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryRepository.
 */
class CategoryRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Category::class;

    /**
     * This method is used by Table Controller
     * For getting the table data to show in
     * the grid
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('module.categories.table').'.id',
                config('module.cagegories.table').'.category_name',
                config('module.cagegories.table').'.category_desc',
                config('module.cagegories.table').'.category_image',

                config('module.categories.table').'.created_at',
                config('module.categories.table').'.updated_at',
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

        if (Category::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.categories.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param Category $category
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(Category $category, array $input)
    {
    	if ($category->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.categories.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param Category $category
     * @throws GeneralException
     * @return bool
     */
    public function delete(Category $category)
    {
        if ($category->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.categories.delete_error'));
    }
}
