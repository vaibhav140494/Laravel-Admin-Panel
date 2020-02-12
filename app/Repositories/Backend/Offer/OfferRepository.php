<?php

namespace App\Repositories\Backend\Offer;

use DB;
use Carbon\Carbon;
use App\Models\Offer\Offer;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OfferRepository.
 */
class OfferRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Offer::class;

    /**
     * This method is used by Table Controller
     * For getting the table data to show in
     * the grid
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('module.offers.table').'.id',
                config('module.offers.table').'.offer_name',
                config('module.offers.table').'.offer_code',
                config('module.offers.table').'.offer_type',
                config('module.offers.table').'.offer_value',
                config('module.offers.table').'.offer_desc',
                config('module.offers.table').'.min_order_value',
                config('module.offers.table').'.max_discount',
                config('module.offers.table').'.min_offer_amount',
                config('module.offers.table').'.is_active',
                config('module.offers.table').'.start_date',
                config('module.offers.table').'.end_date',
                config('module.offers.table').'.no_of_counts',
                config('module.offers.table').'.created_at',
                config('module.offers.table').'.updated_at',
            ]);
    }

    /**
     * For Creating the respective model in storage
     *
     * @param array $input
     * @throws GeneralException
     * @return bool
     */
    public function create(array $input)
    {
        if (Offer::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.offers.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param Offer $offer
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(Offer $offer, array $input)
    {
    	if ($offer->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.offers.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param Offer $offer
     * @throws GeneralException
     * @return bool
     */
    public function delete(Offer $offer)
    {
        if ($offer->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.offers.delete_error'));
    }
}
