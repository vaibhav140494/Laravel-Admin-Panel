<?php

namespace App\Http\Controllers\Backend\Contact;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Contact\ContactRepository;
use App\Http\Requests\Backend\Contact\ManageContactRequest;

/**
 * Class ContactsTableController.
 */
class ContactsTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var ContactRepository
     */
    protected $contact;

    /**
     * contructor to initialize repository object
     * @param ContactRepository $contact;
     */
    public function __construct(ContactRepository $contact)
    {
        $this->contact = $contact;
    }

    /**
     * This method return the data of the model
     * @param ManageContactRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageContactRequest $request)
    {
        return Datatables::of($this->contact->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($contact) {
                return Carbon::parse($contact->created_at)->toDateString();
            })
            ->addColumn('actions', function ($contact) {
                return $contact->action_buttons;
            })
            ->make(true);
    }
}
