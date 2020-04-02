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
        $ans= Datatables::of($this->subcategory->getForDataTable($id))
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
                $route=url("admin/subcategories/edit/".$subcategory->id);
                $route_delete=route('admin.subcategories.destroy',$subcategory->id);
                $buttons = '<a href="'.$route.'" class="btn btn-flat btn-default">
                <i data-toggle="tooltip" data-placement="top" title="Edit" class="fa fa-pencil"></i>
                </a> <a href="'.$route_delete.'" class="btn btn-flat btn-default">
                <i data-toggle="tooltip" data-placement="top" title="Delete" class="fa fa-trash"></i>
                </a>';
                // return $subcategory->action_buttons;
                return $buttons;
            })
            ->make(true);
            // dd($this->subcategory);
            return $ans;
    }
}
