<?php

namespace App\Http\Controllers\Backend\SupportTicket;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\SupportTicket\SupportTicketRepository;
use App\Http\Requests\Backend\SupportTicket\ManageSupportTicketRequest;

/**
 * Class SupportTicketsTableController.
 */
class SupportTicketsTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var SupportTicketRepository
     */
    protected $supportticket;

    /**
     * contructor to initialize repository object
     * @param SupportTicketRepository $supportticket;
     */
    public function __construct(SupportTicketRepository $supportticket)
    {
        $this->supportticket = $supportticket;
    }

    /**
     * This method return the data of the model
     * @param ManageSupportTicketRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageSupportTicketRequest $request)
    {
        
        return Datatables::of($this->supportticket->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($supportticket) {
                return Carbon::parse($supportticket->created_at)->toDateString();
            })
            ->addColumn('actions', function ($supportticket) {
                return $supportticket->action_buttons;
            })
            ->make(true);
    }
}
