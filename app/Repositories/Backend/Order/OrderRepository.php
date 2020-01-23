<?php

namespace App\Repositories\Backend\Order;

use DB;
use Carbon\Carbon;
use App\Models\Order\Order;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderRepository.
 */
class OrderRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Order::class;

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
                config('module.orders.table').'.id',
                config('module.orders.table').'.user_id',
                config('module.orders.table').'.offer_id',
                config('module.orders.table').'.order_id',
                config('module.orders.table').'.instructions',
                config('module.orders.table').'.gross_amount',
                config('module.orders.table').'.tax_amount',
                config('module.orders.table').'.total_amount',
                config('module.orders.table').'.discount',
                config('module.orders.table').'.status',
                config('module.orders.table').'.type',
                config('module.orders.table').'.created_at',
                config('module.orders.table').'.updated_at',
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
        if (Order::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.orders.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param Order $order
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(Order $order, array $input)
    {
    	if ($order->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.orders.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param Order $order
     * @throws GeneralException
     * @return bool
     */
    public function delete(Order $order)
    {
        if ($order->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.orders.delete_error'));
    }
}
