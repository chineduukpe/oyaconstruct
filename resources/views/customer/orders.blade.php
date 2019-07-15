@extends('layout')

@section('content')
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
    @include('utils.errors')
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>Order Date</td>
                    <td>Payment Type</td>
                    <td>Payment Amount</td>
                    <td>Delivery Address</td>
                    <td>Delivery Status</td>
                </tr>
            </thead>
            <tbody>
                @if(empty($orders))
                <tr>
                    <td colspan=5>You have no orders yet. Visit our <a href="{{URL::to('/')}}">market</a> to start shopping!</td>
                </tr>
                @else
                <?php
                    foreach ($orders as $order) {
                        ?>
                            <tr>
                            <td>{{$order->payment_date}}</td>
                            <td>{{$order->payment_type}}</td>
                            <td>{{$order->payment_amount}}</td>
                            <td>{{$order->delivery_address}}</td>
                            <td><span class="{{$order->delivery_status == 0 ? 'text-warning' : 'text-success'}}">{{$order->delivery_status == 0 ? 'Awaiting' : 'Delivered'}}</span></td>
                            <td>
                            @if($order->delivery_status == 0)
                                <a data-toggle='modal' data-url="{{route('customer.orders.cancel',$order->id)}}" href="#confirmOrderDeliveryModal" class="customer-cancel-order text-danger">cancel</a>
                            @endif
                            </td>
                            </tr>
                        <?php
                    }
                ?>
                @endif
            </tbody>
        </table>
    </div>
    <div class="col-md-3"></div>
</div>

<!-- Cancel ORDER modal-->
<div class="modal fade" id="confirmOrderDeliveryModal" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h4>You are about to CANCEL an order.</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to cancel this order?
                <div class="modal-footer">

                    <input type="hidden" name='order_id'>
                    <a type="submit" class="btn btn-danger pull-left" id="confirmCancelOrder"> Confirm</a>
                    <button class="btn btn-secondary" data-dismiss='modal'> Cancel</button>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CANCEL ORDER modal-->
@endsection

@section('script')
<script>
$('a.customer-cancel-order').click(function(e){
    e.preventDefault();
    $('#confirmCancelOrder').attr('href',$(this).attr('data-url'));
    console.log('Deleting')
});
</script>
@endsection