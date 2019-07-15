@extends('adminlayout')

@section('content')
@include('utils.errors')
<table class="table table-striped mt-3">
    <thead>
        <tr>
            <td>Order ID</td>
            <td>Customer name</td>
            <td>Payment Type</td>
            <td>Ref</td>
            <td>Order Amount</td>
            <td>Date</td>
            <td>C-code</td>
            <td>Address</td>
            <td>Delivery Phone</td>
            <td>Order Status</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
        @if(empty($orders))
        <tr>
            <td colspan=6>No customer Orders yet!</td>
        </tr>
        @else
        @foreach($orders as $order)
        <tr>
            <td>{{$order->id}}</td>
            <td>{{$order->paid_by}}</td>
            <td>{{$order->payment_type}}</td>
            <td>{{$order->payment_reference}}</td>
            <td>{{$order->payment_amount}}</td>
            <td>{{$order->payment_date}}</td>
            <td>{{$order->confirmation_code}}</td>
            <td>{{$order->delivery_address}}</td>
            <td>{{$order->delivery_phone}}</td>
            <td id='delivery-status{{$order->id}}'>
                @if($order->delivery_status == 0)
                <a data-action='confirm-order' data-toggle='modal' href="#confirmOrderDeliveryModal" id="{{$order->id}}" class="btn btn-sm btn-warning deliver-order">deliver</a>
                @else
                <span class="text-success">Delivered</span>
                @endif
            </td>
            <td>
                @if($order->delivery_status == 0)

                <a data-toggle='modal' href="#cancelOrderModal" id="{{$order->id}}" class="text-danger">Cancel</a></td>
            @else
            @endif
            <td>

            </td>
        </tr>
        @endforeach
        @endif

    </tbody>
    <tfoot>
        <tr>
            <td colspan=6>
                {{$orders->links()}}
            </td>
        </tr>
    </tfoot>
</table>

<!-- Cancel ORDER modal-->
<div class="modal fade" id="cancelOrderModal" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h4>You are about to cancel an order.</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to cancel this order?
                <div class="modal-footer">
                    <form action="{{route('admin.orders.cancel')}}" method="post">
                        @method('DELETE')
                        <input type="hidden" name='order_id'>
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-danger pull-left"> Confirm</button>
                        <button class="btn btn-secondary" data-dismiss='modal'> Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CANCEL ORDER modal-->
<!-- Cancel ORDER modal-->
<div class="modal fade" id="confirmOrderDeliveryModal" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h4>You are about to CONFRIM an order delivery.</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to confirm this order?
                <div class="modal-footer">

                    <input type="hidden" name='order_id'>
                    <button type="submit" class="btn btn-danger pull-left" data-dismiss='modal' id="confirmDeliverOrderButton"> Confirm</button>
                    <button class="btn btn-secondary" data-dismiss='modal'> Cancel</button>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CANCEL ORDER modal-->
@endsection

@section('style')
<link rel="stylesheet" href="{{asset('aurjn/alertify/css/alertify.min.css')}}">
@endsection

@section('script')

<script src="{{asset('aurjn/alertify/alertify.js')}}"></script>
<script>
    $('a[href="#cancelOrderModal"]').click(function() {
        let $id = $(this).attr('id');
        $('#cancelOrderModal').find(`input[name='order_id']`).val($id);

    });

    $('a[data-action="confirm-order"]').click(function() {
        let id = $(this).attr('id');
        $('#confirmOrderDeliveryModal').find('input[name="order_id"]').val(parseInt(id));
    });

    $('#confirmDeliverOrderButton').click(function() {
        let orderid = $('#confirmOrderDeliveryModal').find('input[name="order_id"]').val();
        let method = 'POST';
        let _method = 'PATCH';
        let _token = $('meta[name="csrf-token"]').attr('content');
        let approved_by = {{Auth::user()-> id }}

        console.log({
            orderid,
            _method,
            _token,
            approved_by
        })
        fr('{{route("admin.orders.deliver")}}', method, {
                orderid,
                approved_by,
                _method,
                _token
            })
            .then(res => {
                console.log(res);
                return res.json();
            })
            .then(data => {
                if (data.error) {
                    return alertify.alert('ERR: ', data.error)
                }
                $('#delivery-status' + orderid).html(`<span class="text-success">Delivered</span>`);
                $('#delivery-status' + orderid).next().html('');
                return alertify.alert('Success:', data.message)
            })
            .catch(err => {
                return alertify.alert('ERR: ', 'A network error has occured. If this problem persist, refresh the page.');
            });
    });
</script>
@endsection