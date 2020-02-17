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
        // $order=DB::table('orders')
        // ->leftjoin('users','users.id','=','orders.user_id')
        // ->leftjoin('offers','offers.id','=','orders.offer_id')
        // ->select('orders.*',\DB::raw("CONCAT(users.first_name,' ',users.last_name) as full_name"),'users.phone_no','offers.offer_code')
        // ->get();
        $order2=Order::all();
        // dd($order[0]);
        $order= $this->query()
        ->leftjoin('users','users.id','=','orders.user_id')
        ->leftjoin('offers','offers.id','=','orders.offer_id')
        ->select([
            config('module.orders.table').'.id',
            // DB::raw('orders.id as id'),
            // config('module.orders.table').'.user_id',
            config('module.orders.table').'.order_id',
            DB::raw('CONCAT(users.first_name," ",users.last_name) as full_name'),
            // config('module.orders.table').'.instructions',
            DB::raw('CONCAT(users.phone_no) as phone_no'),
            config('module.orders.table').'.gross_amount',
            config('module.orders.table').'.tax_amount',
            config('module.orders.table').'.total_amount',
            config('module.orders.table').'.discount',
            config('module.orders.table').'.status',
            config('module.orders.table').'.type',
            DB::raw('CONCAT(offers.offer_code) as offer_code'),
            config('module.orders.table').'.created_at',
            // config('module.orders.table').'.updated_at',

        ]);
        // dd($order);
        return $order;
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
