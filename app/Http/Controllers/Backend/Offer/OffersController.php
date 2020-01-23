<?php

namespace App\Http\Controllers\Backend\Offer;

use App\Models\Offer\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\Offer\CreateResponse;
use App\Http\Responses\Backend\Offer\EditResponse;
use App\Repositories\Backend\Offer\OfferRepository;
use App\Http\Requests\Backend\Offer\ManageOfferRequest;
use App\Http\Requests\Backend\Offer\CreateOfferRequest;
use App\Http\Requests\Backend\Offer\StoreOfferRequest;
use App\Http\Requests\Backend\Offer\EditOfferRequest;
use App\Http\Requests\Backend\Offer\UpdateOfferRequest;
use App\Http\Requests\Backend\Offer\DeleteOfferRequest;

/**
 * OffersController
 */
class OffersController extends Controller
{
    /**
     * variable to store the repository object
     * @var OfferRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param OfferRepository $repository;
     */
    public function __construct(OfferRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\Offer\ManageOfferRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageOfferRequest $request)
    {
        return new ViewResponse('backend.offers.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateOfferRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Offer\CreateResponse
     */
    public function create(CreateOfferRequest $request)
    {
        return new CreateResponse('backend.offers.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreOfferRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreOfferRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.offers.index'), ['flash_success' => trans('alerts.backend.offers.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Offer\Offer  $offer
     * @param  EditOfferRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Offer\EditResponse
     */
    public function edit(Offer $offer, EditOfferRequest $request)
    {
        return new EditResponse($offer);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateOfferRequestNamespace  $request
     * @param  App\Models\Offer\Offer  $offer
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateOfferRequest $request, Offer $offer)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $offer, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.offers.index'), ['flash_success' => trans('alerts.backend.offers.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteOfferRequestNamespace  $request
     * @param  App\Models\Offer\Offer  $offer
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Offer $offer, DeleteOfferRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($offer);
        //returning with successfull message
        return new RedirectResponse(route('admin.offers.index'), ['flash_success' => trans('alerts.backend.offers.deleted')]);
    }
    
}
