<?php

namespace App\Http\Controllers\Backend\Subcategory;
use App\Models\Category\Category;
use App\Models\Subcategory\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\Subcategory\CreateResponse;
use App\Http\Responses\Backend\Subcategory\EditResponse;
use App\Repositories\Backend\Subcategory\SubcategoryRepository;
use App\Http\Requests\Backend\Subcategory\ManageSubcategoryRequest;
use App\Http\Requests\Backend\Subcategory\CreateSubcategoryRequest;
use App\Http\Requests\Backend\Subcategory\StoreSubcategoryRequest;
use App\Http\Requests\Backend\Subcategory\EditSubcategoryRequest;
use App\Http\Requests\Backend\Subcategory\UpdateSubcategoryRequest;
use App\Http\Requests\Backend\Subcategory\DeleteSubcategoryRequest;


/**
 * SubcategoriesController
 */
class SubcategoriesController extends Controller
{
    /**
     * variable to store the repository object
     * @var SubcategoryRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param SubcategoryRepository $repository;
     */
    public function __construct(SubcategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\Subcategory\ManageSubcategoryRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageSubcategoryRequest $request)
    {
        return new ViewResponse('backend.subcategories.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateSubcategoryRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Subcategory\CreateResponse
     */
    public function create(CreateSubcategoryRequest $request)
    {
        return new CreateResponse('backend.subcategories.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSubcategoryRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreSubcategoryRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.subcategories.index'), ['flash_success' => trans('alerts.backend.subcategories.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Subcategory\Subcategory  $subcategory
     * @param  EditSubcategoryRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Subcategory\EditResponse
     */
    public function edit(Subcategory $subcategory, EditSubcategoryRequest $request)
    {
        return new EditResponse($subcategory);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSubcategoryRequestNamespace  $request
     * @param  App\Models\Subcategory\Subcategory  $subcategory
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateSubcategoryRequest $request, Subcategory $subcategory)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $subcategory, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.subcategories.index'), ['flash_success' => trans('alerts.backend.subcategories.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteSubcategoryRequestNamespace  $request
     * @param  App\Models\Subcategory\Subcategory  $subcategory
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Subcategory $subcategory, DeleteSubcategoryRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($subcategory);
        //returning with successfull message
        return new RedirectResponse(route('admin.subcategories.index'), ['flash_success' => trans('alerts.backend.subcategories.deleted')]);
    }
    
}
