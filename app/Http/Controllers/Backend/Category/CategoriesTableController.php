<?php

namespace App\Http\Controllers\Backend\Category;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Category\CategoryRepository;
use App\Http\Requests\Backend\Category\ManageCategoryRequest;
use Illuminate\Support\Facades\Storage;

/**
 * Class CategoriesTableController.
 */
class CategoriesTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var CategoryRepository
     */
    protected $category;

    /**
     * contructor to initialize repository object
     * @param CategoryRepository $category;
     */
    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    /**
     * This method return the data of the model
     * @param ManageCategoryRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageCategoryRequest $request)
    {
        return Datatables::of($this->category->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('category_image', function ($category) {
                // dd(url('/'));
                
                $url=url('storage/category/'.$category->category_image);
                // dd($url);
                // dd();
                return '<img src="'.$url.'" border="0" width="70" height="70" class="img-thumbnail" align="center" />';
                
            })
            ->addColumn('category_name', function ($category) {
                // echo $category->id;
                // $path="http://127.0.0.1:8000/admin/categories/".$category->id."/get";
                $path=url('/admin/categories/'.$category->id.'/get');
                return '<a href="'.$path.'" style="color:#000;">'.$category->category_name. '</a> ';
            })
            ->addColumn('created_at', function ($category) {
                return Carbon::parse($category->created_at)->toDateString();
            })
            ->addColumn('actions', function ($category) {
                return $category->action_buttons;
            })
            ->make(true);


        // return Datatables::of($this->category->getForDataTable())
        //     ->escapeColumns(['id'])
        //     ->addColumn('category_image', function ($category) {
        //         return echo '<img src="{{ public_path(\'/storage/category\'.$category->category_image)}}">';
        //     })
        //     ->addColumn('created_at', function ($category) {
        //         return Carbon::parse($category->created_at)->toDateString();
        //     })
        //     ->addColumn('actions', function ($category) {
        //         return $category->action_buttons;
        //     })
        //     ->make(true);
    }
}
