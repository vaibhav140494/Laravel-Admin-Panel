<?php

namespace App\Http\Controllers\Backend\Subcategory;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Subcategory\SubcategoryRepository;
use App\Http\Requests\Backend\Subcategory\ManageSubcategoryRequest;

/**
 * Class SubcategoriesTableController.
 */
class SubcategoriesTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var SubcategoryRepository
     */
    protected $subcategory;

    /**
     * contructor to initialize repository object
     * @param SubcategoryRepository $subcategory;
     */
    public function __construct(SubcategoryRepository $subcategory)
    {
        $this->subcategory = $subcategory;
    }

    /**
     * This method return the data of the model
     * @param ManageSubcategoryRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageSubcategoryRequest $request,$id)
    {
        // echo $id; exit;
        return Datatables::of($this->subcategory->getForDataTable($id))
            ->escapeColumns(['id'])
            ->addColumn('subcategory_name', function ($subcategory) {
                return $subcategory->subcategory_name;
            })
            ->addColumn('subcategory_desc', function ($subcategory) {
                return $subcategory->subcategory_desc;
            })
            ->addColumn('category_id', function ($subcategory) {
                return $subcategory->category_id;
            })
            ->addColumn('is_active', function ($subcategory) {
                return $subcategory->is_active;
            })
            ->addColumn('created_at', function ($subcategory) {
                return Carbon::parse($subcategory->created_at)->toDateString();
            })
            ->addColumn('actions', function ($subcategory) {
                return $subcategory->action_buttons;
            })
            ->make(true);
    }
}
