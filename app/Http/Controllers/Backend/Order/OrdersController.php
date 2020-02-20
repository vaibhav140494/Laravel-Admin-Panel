<?php

namespace App\Http\Controllers\Backend\Order;

use App\Models\Order\Order;
use App\Models\User\User;
use App\Models\User\multipleAddress;
use App\Models\Order\orderDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\Order\CreateResponse;
use App\Http\Responses\Backend\Order\EditResponse;
use App\Repositories\Backend\Order\OrderRepository;
use App\Http\Requests\Backend\Order\ManageOrderRequest;
use App\Http\Requests\Backend\Order\CreateOrderRequest;
use App\Http\Requests\Backend\Order\StoreOrderRequest;
use App\Http\Requests\Backend\Order\EditOrderRequest;
use App\Http\Requests\Backend\Order\UpdateOrderRequest;
use App\Http\Requests\Backend\Order\DeleteOrderRequest;
use DB;

/**
 * OrdersController
 */
class OrdersController extends Controller
{
    /**
     * variable to store the repository object
     * @var OrderRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param OrderRepository $repository;
     */
    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
        parent::__construct();
        
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\Order\ManageOrderRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageOrderRequest $request)
    {
        return new ViewResponse('backend.orders.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateOrderRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Order\CreateResponse
     */
    public function create(CreateOrderRequest $request)
    {
        return new CreateResponse('backend.orders.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreOrderRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreOrderRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.orders.index'), ['flash_success' => trans('alerts.backend.orders.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Order\Order  $order
     * @param  EditOrderRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Order\EditResponse
     */
    public function edit(Order $order, EditOrderRequest $request)
    {
        return new EditResponse($order);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateOrderRequestNamespace  $request
     * @param  App\Models\Order\Order  $order
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $order, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.orders.index'), ['flash_success' => trans('alerts.backend.orders.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteOrderRequestNamespace  $request
     * @param  App\Models\Order\Order  $order
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Order $order, DeleteOrderRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($order);
        //returning with successfull message
        return new RedirectResponse(route('admin.orders.index'), ['flash_success' => trans('alerts.backend.orders.deleted')]);
    }

    public function viewOrder($id)
    {
        $orders= DB::table('orders')
        ->leftjoin('users','users.id','=','orders.user_id')
        ->join('order_details','orders.id','=','order_details.order_id')
        ->leftjoin('multiple_address','users.default_address','=','multiple_address.id')
        ->select('orders.*',DB::raw('sum(order_details.total_amount) as total_amount'),DB::raw('sum(order_details.tax_amount) as tax_amount'),DB::raw('CONCAT(users.first_name," ",users.last_name) as user_name'),'users.phone_no','multiple_address.country','multiple_address.state','multiple_address.city','multiple_address.address','multiple_address.pincode')
        ->where('orders.id',$id)->get()->first();

        $order_details=DB::table('orders')
        ->join('order_details','orders.id','=','order_details.order_id')
        ->join('products','products.id','=','order_details.product_id')
        ->select('orders.*','order_details.product_id','order_details.id as ordersdetails_id','order_details.quntity','order_details.gross_amount','order_details.tax_amount','order_details.total_amount','products.product_name')
        ->where('orders.id',$id)
        ->get();
        return view('backend.orders.view_order_details',compact('order_details','orders'));
    }
    
    public function updateStatus(Request $request)
    {   
        $id=$request->input('order_id');
        $order=Order::find($id);
        $order->status= $request->input('status');
        $order->save();
        return redirect()->route('admin.view.order',[$order->id]);
    }
}
