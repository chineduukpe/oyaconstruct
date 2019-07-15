<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title','Oyaconstruct - Home of everything construction related')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Shop for construction materials online. Buy and order material. Create your store and have oyaconstruct buy from you." />
    <meta name="author" content="Oyaconstruct" />
    @yield('metasection')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::asset('https://use.fontawesome.com/releases/v5.7.0/css/all.css') }}">
    <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/mystyle.css') }}">
    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{URL::asset('ico/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{URL::asset('ico/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{URL::asset('ico/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{URL::asset('ico/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{URL::asset('ico/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{URL::asset('ico/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{URL::asset('ico/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{URL::asset('ico/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{URL::asset('ico/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{URL::asset('ico/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{URL::asset('ico/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{URL::asset('ico/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{URL::asset('v/favicon-16x16.png')}}">
    <link rel="manifest" href="{{URL::asset('ico/manifest.json')}}">
    <link rel="manifest" href="{{URL::asset('mdb/css/mdb.min.css')}}">
    <!-- JQuery -->
    <script type="text/javascript" src="{{ URL::asset('js/jquery-3.3.1.min.js') }}"></script>
</head>

<body>
    <!-- BODY RECEIPT -->
    <div class="container">
        <div class="row">
            <!-- RECEIPT HEADER -->
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <a href="/" class="text-danger ">Home</a>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12 mt-5">
                                <h3 >Thank You {{explode(' ',$order->user()->first()->name)[0]}}!</h3>
                            </div>
                            <div class="col-md-12">
                                <img src="" class='h-100 w-100' alt="">
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>
            <!-- BILLING ADDRESS -->
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 box">
                        <p>&nbsp </p>
                        <h3>Billing Address</h3>
                        <p>{{$order->user()->first()->address}}</p>
                    </div>
                    <div class="col-md-6 box">
                        <p>Order ID: OYA{{$order->id}}</p>
                        <h3>Shipping Address</h3>
                        <p>{{$order->delivery_address}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-5">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>SKU</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->cart()->first()->cartProducts as $cartProduct)
                        <tr>
                            <td>{{$cartProduct->product()->first()->productname}}</td>
                            <td>343609</td>
                            <td><del>N</del>{{$cartProduct->cost}}</td>
                            <td>5</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Product</th>
                            <th>SKU</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <h5><strong>Subtotal:</strong> <del>N</del> {{$order->payment_amount}}</h5>
                        <h5><strong>Shipping:</strong> free</h5>
                        <h4><strong>total:</strong> {{$order->payment_amount}}</h4>

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <p>
                            <h4>Payment Method</h4>
                        </p>
                        <p>
                            <h5 class="text-danger">{{$order->payment_method == 'cash' ? 'Cash on Delivery (COD)' : 'Online Pay'}}</h5>
                        </p>
                    </div>
                    <div class="col-md-6">

                        <button class="btn btn-lg btn-danger" onclick="window.print()">Print</button>
                    </div>

                </div>
            </div>
            <div class="col-md-12">
            </div>
        </div>
    </div>
    <script src="{{URL::asset('js/popper.min.js')}}"></script>
    <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('mdb/js/mdb.min.js')}}"></script>
</body>

</html>