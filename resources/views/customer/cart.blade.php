@extends('layout')

@section('content')
<div class="row mt-5 cart-bg">
    <div class="col-md-2"></div>
    <div class="col-md-6">
        @include('utils.errors')
        <div class="card">
            <div class="cardheader p-4">
                <h3 class=" font-weight-bolder">
                    Cart ({{$cart ? ($cart->cartProducts()->first()->id ? count($cart->cartProducts) : 0) : 0}})
                </h3>
            </div>
        </div>

        @if(!empty($cart) && !empty($cart->cartProducts->first()))
        @foreach($cart->cartProducts as $cartProduct)
        <div class="card mb-2 p-3 shadow-sm" id="cartItemParent{{$cartProduct->id}}">
            <div class="cardheader">
                <div class="row">
                    <div class="col-md-6">
                        Seller: {{$cartProduct->product()->first()->store->ownername}}
                    </div>
                    <div class="col-md-6 text-right">
                        <span class="text-right">discount: none</span>
                        <a href="{{route('customer.cart.delete.product',[Auth::user()->id, $cartProduct->id])}}" id="{{$cartProduct->product()->first()->productname}}" trigger="delete-cart-item"><i class='fa fa-trash text-danger'></i></a>
                    </div>
                </div>

            </div>
            <div class="cardbody">
                <div class="row">
                    <div class="col-md-4" style="max-height: 100px">
                        <img src="{{route('image.get',$cartProduct->product()->first()->productpic)}}" alt="" class="h-100">
                    </div>
                    <div class="col-md-8">
                        <h3>{{$cartProduct->product->first()->productname}}</h3>
                        <small>{{str_limit($cartProduct->product->first()->shortdesc,200,'...')}}</small><br>
                        <small>Quantity: {{$cartProduct->quantity}}</small><br>
                        <small>Price: <del>N</del> {{$cartProduct->cost}}</small>
                    </div>
                </div>
            </div>
            <div class="cardfooter">
                <div class="row">
                    <div class="col-md-6">
                        Colour: {{$cartProduct->colourid ? $cartProduct->colour->colour : 'Any'}}
                    </div>
                    <div class="col-md-6">
                        Size: {{$cartProduct->sizeid ? $cartProduct->size->size : 'Any'}}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="jumbotron mt-2">
            <h5>Empty Cart</h5>
            <p>You do not have any product in your cart. Go to <a href="/" class='text-danger'>market</a> and start shoping.</p>
        </div>
        @endif
    </div>
    <div class="col-md-2 jumbotron p-5" style="max-height: 400px">
        <h3 class="font-weight-bold">Order Summary</h3>
        <p><small>Subtotal: {{number_format($total,2)}}</small></p>
        <p><small>Shipping: Free</small></p>
        <p class="font-weight-bold m-2">Total: <del>N</del>{{number_format($total,2)}}</p>
        <a href="#paystackpayment" data-toggle="modal" class="btn btn-danger btn-block btn-lg"> <i class="fa fa-card"></i> Checkout</a>
        <a href="#cashPaymentModal" data-toggle="modal" class="btn btn-warning btn-block btn-lg"> <i class="fa fa-cash"></i> Pay Cash</a>
    </div>
    <div class="col-md-2"></div>
</div>


@if(Auth::check())
<!-- BEGIN PAYSTACK PAYMENT MODAL -->
<!-- Paystack payment modal -->
<div class="modal fade" id="paystackpayment" tabindex="-1" role="dialog" aria-labelledby="contact" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Paystack payment modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="p-2 " enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <p><span class="red-text">You are about make payment using paystack. Confirm the amount and click pay now to continue.</span></p>
                    <div class="form-group">
                        <label for="telleramt">Amount</label>
                        <input type="number" id="paystackamt" name="paystackamt" class="form-control" required="required" readonly="readonly" value="{{$total}}">
                        <input type="hidden" id="paytype" name="paytype" class="form-control">
                        <input type="hidden" id="paystackuserid" name="paystackuserid" class="form-control" value="{{Auth::user()->id}}">
                        <input type="hidden" id="paystackphone" name="paystackphone" value="{{Auth::user()->phone}}" class="form-control">
                        <input type="hidden" id="paystackfname" name="paystackfname" class="form-control" value="{{explode(' ',Auth::user()->name)[0]}}">
                        <input type="hidden" id="paystacklname" name="paystacklname" class="form-control" value="{{explode(' ',Auth::user()->name)[1]}}">

                    </div>
                    <div class="form-group">
                        <label for="">Delivery Address</label><br>
                        <small>Your registered address will be used if left empty</small>
                        <input type="text" name="delivery_address" class="form-control">
                        <input type="hidden" name="my_address" value="{{Auth::check() ? Auth::user()->address : null}}" class="form-control">
                    </div>
                    <div class="text-center mt-4">
                        <script src="https://js.paystack.co/v1/inline.js"></script>
                        <button type="button" onclick="payWithPaystack()" class="btn btn-danger btn-lg"> Pay Now</button>

                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
<!-- Paystack payment modal -->
<!-- BEGIN CASH PAYMENT MODAL -->
<!-- Paystack payment modal -->
<div class="modal fade" id="cashPaymentModal" tabindex="-1" role="dialog" aria-labelledby="contact" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Cash Payment </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="p-2 " method="POST" action="{{route('customer.cart.paycash')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <p><span class="red-text">You are about make order With Cash Payment. Confirm the amount and address and click pay now to continue.</span></p>
                    <div class="form-group">
                        <label for="telleramt">Amount</label>
                        <input type="number" name="paystackamt" class="form-control" required="required" readonly="readonly" value="{{$total}}">
                        <input type="hidden" name="paytype" class="form-control">
                        <input type="hidden" name="paystackuserid" class="form-control" value="{{Auth::user()->id}}">
                        <input type="hidden" name="phone" value="{{Auth::user()->phone}}" class="form-control">
                        <input type="hidden" name="firstname" class="form-control" value="{{explode(' ',Auth::user()->name)[0]}}">
                        <input type="hidden" name="lastname" class="form-control" value="{{explode(' ',Auth::user()->name)[1]}}">

                    </div>
                    <div class="form-group">
                        <label for="">Delivery Address</label><br>
                        <small>Your registered address will be used if left empty</small>
                        <input type="text" name="cash_delivery_address" class="form-control">
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-danger btn-block"> Pay Now</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
<!-- END PAY CASH payment modal -->
@endif
<!-- END PAYMENT MODAL -->
@endsection

@section('script')
<script src="{{asset('js/aurjn/dev.c.lib.js')}}"></script>
<script src="{{asset('js/aurjn/devc.js')}}"></script>
<script>
    function payWithPaystack() {
        $delivery_address = $('input[name="delivery_address"]');
        $my_address = $('input[name="my_address"]');
        
        if (isFieldEmpty($delivery_address.val()) && isFieldEmpty($my_address.val())) {
            return alertify.alert('Checkout: ', 'You seem not to have a delivery address. Enter a delivery address to continue.');
        }
        
        // Use the user's registered address if the user leave the delivery address field empty
        $delivery_address = $delivery_address.val() ? $delivery_address.val() : $my_address.val();
        
        var loanid = $("#mloanid").val();
        var paymenttype = document.getElementById('paytype').value;
        var fname = document.getElementById('paystackfname').value;
        var lname = document.getElementById('paystacklname').value; 
        let userid = $('input[name="paystackuserid"]').val();
        console.log('Starting Paystack payment')
        console.log(userid)
        fr('/api/cart/verifypaymentamount', "POST", {
            userid
        })
        .then(res => {
            console.log(res)
            return res.json();
        })
        .then(data => {
            if (data.error) {
                return alert('error occured');
            }
            if (!data.amount) {
                return alert('Could not resolve the order amount');
            }
            console.log('Finishing Paystack payment')
            var handler = PaystackPop.setup({
                key: 'pk_test_0690f6e1462b8db16ba88012c5434ced1d571f09', //public key, dont worry about this
                email: '{{Auth::check()  ? Auth::user()->email : null}}', //this should be users email, but replace it with a figi email
                
                amount: data.amount * 100, //amount is in kobo, so NGN * 100
                currency: "NGN",
                ref: '' + Math.floor((Math.random() * 1000000000) + 1), // generates a reference code. 
                //last paid generated ref by me: 716169799, save the code and remove this line.
                firstname: fname,
                lastname: lname,
                metadata: {
                    custom_fields: [{
                        display_name: fname + " " + lname,
                        variable_name: "mobile_number", //no need to specify this field
                        value: document.getElementById('paystackphone').value //user mobile number should be here
                    }]
                },
                callback: function(response) {
                    //alert('success. transaction ref is ' + response.reference);
                    window.location = "{{URL::to('paystackpayment')}}?reference=" + response.reference + "&paymenttype=" + paymenttype + "&username=" + loanid + '&cartid={{$cart ? $cart->id : ""}}' + "&address=" + $delivery_address;
                },
                onClose: function() {
                    ;
                }
            });
            handler.openIframe();
        });
    }
    
    </script>
@endsection