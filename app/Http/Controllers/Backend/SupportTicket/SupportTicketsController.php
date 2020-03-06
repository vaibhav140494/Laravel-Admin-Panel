<?php

namespace App\Http\Controllers\Backend\SupportTicket;

use App\Models\SupportTicket\SupportTicket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\SupportTicket\CreateResponse;
use App\Http\Responses\Backend\SupportTicket\EditResponse;
use App\Repositories\Backend\SupportTicket\SupportTicketRepository;
use App\Http\Requests\Backend\SupportTicket\ManageSupportTicketRequest;
use App\Http\Requests\Backend\SupportTicket\CreateSupportTicketRequest;
use App\Http\Requests\Backend\SupportTicket\StoreSupportTicketRequest;
use App\Http\Requests\Backend\SupportTicket\EditSupportTicketRequest;
use App\Http\Requests\Backend\SupportTicket\UpdateSupportTicketRequest;
use App\Http\Requests\Backend\SupportTicket\DeleteSupportTicketRequest;

/**
 * SupportTicketsController
 */
class SupportTicketsController extends Controller
{
    /**
     * variable to store the repository object
     * @var SupportTicketRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param SupportTicketRepository $repository;
     */
    public function __construct(SupportTicketRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\SupportTicket\ManageSupportTicketRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageSupportTicketRequest $request)
    {
        return new ViewResponse('backend.supporttickets.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateSupportTicketRequestNamespace  $request
     * @return \App\Http\Responses\Backend\SupportTicket\CreateResponse
     */
    public function create(CreateSupportTicketRequest $request)
    {
        return new CreateResponse('backend.supporttickets.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSupportTicketRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreSupportTicketRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.supporttickets.index'), ['flash_success' => trans('alerts.backend.supporttickets.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\SupportTicket\SupportTicket  $supportticket
     * @param  EditSupportTicketRequestNamespace  $request
     * @return \App\Http\Responses\Backend\SupportTicket\EditResponse
     */
    public function edit(SupportTicket $supportticket, EditSupportTicketRequest $request)
    {   
        //dd($supportticket->id);
        return new EditResponse($supportticket);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSupportTicketRequestNamespace  $request
     * @param  App\Models\SupportTicket\SupportTicket  $supportticket
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateSupportTicketRequest $request, SupportTicket $supportticket)
    {
        //Input received from the request
        $input = $request->except(['_token','first_name','topic','oid']);
        //dd($input);
        //Update the model using repository update method
        $this->repository->update( $supportticket, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.supporttickets.index'), ['flash_success' => trans('alerts.backend.supporttickets.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteSupportTicketRequestNamespace  $request
     * @param  App\Models\SupportTicket\SupportTicket  $supportticket
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(SupportTicket $supportticket, DeleteSupportTicketRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($supportticket);
        //returning with successfull message
        return new RedirectResponse(route('admin.supporttickets.index'), ['flash_success' => trans('alerts.backend.supporttickets.deleted')]);
    }
    
}
