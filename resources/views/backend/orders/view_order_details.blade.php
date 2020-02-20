@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.orders.management'))

@section('page-header')
    <h1>{{ trans('labels.backend.orders.management') }}</h1>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row gutter-10">
        <div class="col-sm-12">
            <div class="containerbg">
                <div class="main-heading title-row mbp15">
                    <div class="row">
                        <div class="col-sm-12">
                            <h1 class="heading01">Order Details</h1>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @if (\Session::has('success'))
                        <div class="col-xl-12 m-section__content toast-container ">
                            <div class="m-alert m-alert--outline alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                </button>
                                <strong> {!! \Session::get('success') !!}</strong>
                            </div>
                        </div>
                    @endif
                    @if (\Session::has('error'))
                        <div class="col-xl-12 m-section__content">
                            <div class="m-alert m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                </button>
                                <strong> {!! \Session::get('error') !!}</strong>
                            </div>
                        </div>
                    @endif
                    @if (isset($errorMessage) && $errorMessage) 
                        <div class="col-xl-12 m-section__content">
                            <div class="m-alert m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                </button>
                                <strong> {{$errorMessage}}</strong>
                            </div>
                        </div>
                    @endif

                    <div class="col-xs-5 col-sm-7  col-md-7 mbp5 pull-left">
                        <a href="{{route('admin.orders.index')}}" class="btn btn-warning"><i class="fa  fa-arrow-left"></i> Back</a>
                    </div>
                </div>
                
                
                <div class="row ptp5 gutter-10">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2" for="email">Order Id :</label>
                            <div class="col-sm-10">
                                <span>{{$orders->order_id}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2" for="email">Customer Name :</label>
                            <div class="col-sm-10">
                                <span>{{$orders->user_name}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2" for="email">Contact No :</label>
                            <div class="col-sm-10">
                                <span>{{$orders->phone_no}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2" for="email">Order Date :</label>
                            <div class="col-sm-10">
                                <span><?php $date=date_create($orders->created_at);
                                        echo date_format($date,"d M, Y H:i A"); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2" for="email">Total Amount :</label>
                            <div class="col-sm-10">
                                <span>{{$orders->total_amount}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2" for="email">Tax Amount :</label>
                            <div class="col-sm-10">
                                <span>{{$orders->tax_amount}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2" for="email">Total Discount :</label>
                            <div class="col-sm-10">
                                <span>{{$orders->discount}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2" for="email">Order Type :</label>
                            <div class="col-sm-10">
                                @if($orders->type==1)
                                    <span> Delivery</span>
                                @else
                                <span> Pickup</span>
                                @endif
                            </div>
                        </div>
                      
                            <div class="form-group">
                                <label class="col-sm-2" for="email">Delivery Address :</label>
                                <div class="col-sm-10">
                                    <span>
                                        {{$orders->address}}

                                    </span>
                                </div>
                            </div>
                      
                        <div class="form-group">
                            <label class="col-sm-2" for="email">Status :</label>
                            <div class="col-sm-10">
                            {{$orders->status}}
                            </div>
                        </div>
                    </div>
                    <form  method="POST" action="{{route('admin.update.order.status')}}" enctype="multipart/form-data"  id="form">
                        {{ csrf_field() }}
                        <input type="hidden" name="order_id" value="{{$orders->id}}">
                        <div class="row gutter-20">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="state" class="control-label"> Order Status</label>
                                    <select class="form-control" id="status" name="status">
                                        {{--@if($users[0]['type'] == '2')--}}
                                            <option value="placed" id="0" <?php  echo ($orders->status=="placed") ? "selected" : '' ?>>Order Placed</option>
                                            <option value="confirmed"  id="1" <?php  echo ($orders->status=="confirmed") ? "selected" : "" ?>>Order Confirmed</option>
                                            <option value="dispatched" id="2"  <?php echo ($orders->status=="dispatched") ? "selected" : "" ?>>Order Dispatched</option>
                                            <option value="delivered"  id="3" <?php  echo ($orders->status=="delivered") ? "selected" : "" ?>>Order Delivered</option>
                                            <option value="returned" id="4"  <?php  echo ($orders->status=="returned") ? "selected" : "" ?>> Order Returned</option>
                                            <option value="refunded"  id="5" <?php  echo ($orders->status=="refunded") ? "selected" : "" ?>>Order Refunded</option>
                                            <option value="cancelled" id="6"  <?php  echo ($orders->status=="cancelled") ? "selected" : "" ?>>Order Cancelled</option>
                                        {{--@else--}}
                                        <!--     <option value="0" <?php  //echo ($users[0]['status']==0) ? "selected" : "" ?>>Order Placed</option>
                                            <option value="1" <?php // echo ($users[0]['status']==1) ? "selected" : "" ?>>Order Confirmed</option>
                                            <option value="2" <?php  //echo ($users[0]['status']==2) ? "selected" : "" ?>>Order is being Prepared</option>
                                            <option value="3" <?php  //echo ($users[0]['status']==3) ? "selected" : "" ?>>Order is Ready</option>
                                            <option value="5" <?php  //echo ($users[0]['status']==5) ? "selected" : "" ?>>Order Delivered</option> -->
                                        {{--@endif--}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <button type="submit"  class="update_status btn btn-warning mtp5">Update</button>
                        </div>
                    </form>
                   
                    <div class="col-sm-12" style="margin-top: 20px;">
                        <div class="table-responsive">
                            <table class="table table-bordered tablestyle">
                                <thead>
                                    <tr>
                                    <th align="left" valign="middle">Product Name</th>  
                                    <th align="left" valign="middle">Quantity</th>
                                    <th align="left" valign="middle">Price Per Product</th>
                                    <th align="left" valign="middle">Gross Amount</th>
                                    <th align="left" valign="middle">Tax Amount</th>
                                    <th align="left" valign="middle">Discount Amount</th>
                                    <th align="left" valign="middle">Total Amount</th>
                                    <th align="left" valign="middle">Instructions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($order_details->count() == 0)
                                        <tr><td colspan="8"  style="text-align:center;">No record found</td>
                                    @endif
                                    
                                    @foreach($order_details as $order_det)
                                        <tr>
                                            <td>{{$order_det->product_name}}</td>
                                            <td>{{$order_det->quntity}}</td>
                                            <td>{{$order_det->gross_amount}}</td>
                                            <td>{{$order_det->gross_amount}}</td>
                                            <td>{{$order_det->tax_amount}}</td>
                                            <td>{{$order_det->discount}}</td>
                                            <td>{{$order_det->total_amount}}</td>
                                            <td>{{$order_det->instructions}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
</div>

@endsection
@section('after-scripts')
<script type="text/javascript">
$( function () {
        if ( sessionStorage.reloadAfterPageLoad == 1 ) {
            alert( "Order status updated successfully." );
            sessionStorage.reloadAfterPageLoad = false;
        } else if ( sessionStorage.reloadAfterPageLoad == 2 ) {
            alert( "Order status update failed." );
            sessionStorage.reloadAfterPageLoad = false;
        }
    } 
);
$(document).ready(function(){
        var selected= $('#status :selected').attr('id');
        $('#status > option').each(function() {
            id=$(this).attr('id');
            // alert(id);
            if(selected > id ){
                $('#'+id).attr('disabled',true);
            }
        });
    setTimeout(function(){ $(".m-section__content").fadeOut("slow"); }, 3000);

    // $(".update_status").on("click", function(){
    //     if(confirm('Are you sure you want to update order status?'))
    //     {
    //         var oid = $(this).attr("oid");
    //         var status = $( "#status option:selected" ).val();
    //         // var status = $(this).attr("statusId");
    //         $.ajax({
    //             type: "POST",
    //             url: "<?php //echo url('/'); ?>/orders/updateStatus/"+oid,
    //             data: {
    //                 "_token": "{{ csrf_token() }}",
    //                 "id": oid,
    //                 "status": status
    //             },
    //             success: function (result) {
    //                 console.log(result);
    //                 if(result.status == 200)
    //                 {
    //                     sessionStorage.reloadAfterPageLoad = 1;
    //                     window.location.href = "<?php //echo url('/'); ?>/orders/viewOrder/"+oid;
    //                 }
    //                 else
    //                 {
    //                     sessionStorage.reloadAfterPageLoad = 2;
    //                     window.location.href = "<?php //echo url('/'); ?>/orders/viewOrder/"+oid;
    //                 }
    //             }
    //         });
    //     }
    //     else
    //     {
    //         return false;
    //     }
    // });
});
</script>
@endsection



