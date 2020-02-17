<?php

namespace App\Http\Controllers\Backend\Order;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Order\OrderRepository;
use App\Http\Requests\Backend\Order\ManageOrderRequest;

/**
 * Class OrdersTableController.
 */
class OrdersTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var OrderRepository
     */
    protected $order;

    /**
     * contructor to initialize repository object
     * @param OrderRepository $order;
     */
    public function __construct(OrderRepository $order)
    {
        $this->order = $order;
    }

    /**
     * This method return the data of the model
     * @param ManageOrderRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageOrderRequest $request)
    {

        $ans = Datatables::of($this->order->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($order) {
                return Carbon::parse($order->created_at)->toDateString();
            })
            ->addColumn('full_name',function($order){
                return $order->full_name;
            })
            ->addColumn('actions', function ($order) {
                $route=url('admin/view/order/details/'.$order->id);
                return '<a href="'.$route.'" class="btn btn-flat btn-default">
                <i data-toggle="tooltip" data-placement="top" title="View Order Details" class="fa fa-eye"></i>
                </a>';
            })
            ->make(true); 
            return $ans;
    }
}
