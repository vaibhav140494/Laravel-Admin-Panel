<?php

namespace App\Http\Controllers\Backend\Offer;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Offer\OfferRepository;
use App\Http\Requests\Backend\Offer\ManageOfferRequest;

/**
 * Class OffersTableController.
 */
class OffersTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var OfferRepository
     */
    protected $offer;

    /**
     * contructor to initialize repository object
     * @param OfferRepository $offer;
     */
    public function __construct(OfferRepository $offer)
    {
        $this->offer = $offer;
    }

    /**
     * This method return the data of the model
     * @param ManageOfferRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageOfferRequest $request)
    {
        return Datatables::of($this->offer->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($offer) {
                return Carbon::parse($offer->created_at)->toDateString();
            })
            ->addColumn('actions', function ($offer) {
                return $offer->action_buttons;
            })
            ->make(true);
    }
}
