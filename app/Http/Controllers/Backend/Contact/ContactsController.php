<?php

namespace App\Http\Controllers\Backend\Contact;

use App\Models\Faqs\contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\Contact\CreateResponse;
use App\Http\Responses\Backend\Contact\EditResponse;
use App\Repositories\Backend\Contact\ContactRepository;
use App\Http\Requests\Backend\Contact\ManageContactRequest;

/**
 * ContactsController
 */
class ContactsController extends Controller
{
    /**
     * variable to store the repository object
     * @var ContactRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param ContactRepository $repository;
     */
    public function __construct(ContactRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\Contact\ManageContactRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageContactRequest $request)
    {
        return new ViewResponse('backend.contacts.index');
    }
    
}
