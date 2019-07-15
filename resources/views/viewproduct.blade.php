@extends('layout')
 @section('metasection')
 @if(!Auth::guest())
<meta name="userid" content="{{Auth::user()->id ? Auth::user()->id : ''}}"> 
<meta name="session" content="{{Auth::user()->session()->first()->id ? Auth::user()->session()->first()->id : ''}}"> 
@endif
@endsection

@section('title')
 Shop products 
 
 @endsection 
 @section('style')
<link rel="stylesheet" href="{{URL::to(asset('aurjn/alertify/css/alertify.min.css'))}}">
<link rel="stylesheet" href="{{URL::to(asset('css/aurjn/devc.css'))}}"> 
@endsection
 @section('content')
  {{--BEGIN PRODUCT DETAIL ROW--}}
<div class="row m-2 mt-5">
    <div class="col-md-2"></div>
    {{--START PICTURE CONTENT--}}
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12 justify-content-center img-magnifier-container" style="max-height: 40vh">
                <img src="{{route('image.get',$products->productpic)}}" alt="{{$products->productname}} " id="productMainPhoto" style=" max-height: 100%">
            </div>
            <div class="col-md-12 m-4">
                <div class="row">
                    @if(!empty($products->pictures))
                     @foreach($products->pictures as $picture)
                    <div class="col-sm-2 m-1" style="height: 50px; ">
                        {{--
                        <div class="card-body ml-1" style="height: 200px; width: 200px;">--}}
                            <img src="{{route('image.get',$picture->picturename)}}" alt="{{$products->productname}}" style="max-height: 100%;" class="img img-responsive  product-alt-photo"> {{--
                        </div>--}}
                    </div>
                    @endforeach
                     @endif
                </div>
            </div>
        </div>
    </div>
    {{--EMD PICTURE CONTENT--}} 
    {{--BEGIN PRODUCT DETAILS--}}

    <div class="col-md-6 ">
        <form action="#" id='addToCartForm'>
            {{csrf_field()}}
            <input type="hidden" name="productid" value="{{$products->id}}">
            <h3>{{$products->productname}}</h3>
            <small>
                <p>{{$products->shortdesc}}</p>
                <p><span class="fa fa-star checkedt text-warning "></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span></p>
            </small>
            <div class="row mt-4 mb-1">
                <div class="col-md-12">
                    <h2><del>N</del> {{$products->price ? $products->price : $products->productPrices()->get()->first()->price }}
                    </h2>
                </div>
                <div class="col-sm-12">
                    <p><small>Quantity</small>:</p>
                    <input type="number" value="1" name="quantity" class="">
                </div>
                <div class="col-sm-12 mt-4">
                    <p><small><strong>Available Colours</strong></small></p>
                    @if($products->colours) @foreach($products->colours as $colour)
                    <div class="col-sm-1 ml-2 " colour="{{$colour->id}}" style="background: {{$colour->colour}}; display: inline-block; cursor:pointer ">
                        <input type="radio" class="product-purchase-colour" value="{{$colour->id}}" name='product-colour' style="background: {{$colour->colour}}; display: inline-block; cursor:pointer ">
                    </div>
                    @endforeach @endif
                </div>
                <div class="col-sm-12 mt-4">
                    <p><small><strong>Available Sizes</strong></small></p>
                    <div class="row">
                        @if($products->productPrices()->get()) @foreach($products->productPrices()->get() as $price)
                        <div class="col-sm-2 col-md-1 ml-2 " style="display: inline-block; "> 
                        <input type="radio" name="size" class='bg-warning' value="{{$price->size()->first()->id}}"> {{$price->first()->size()->first()->size}}
                        </div>
                        @endforeach @endif
                    </div>
                </div>
            </div>
            <div class="row m-3">
                <a href="#" class="btn btn-lg btn-danger m-1"> <i class="fa fa-wallet"></i> Buy now</a>
                <button id="addToCartButton" class="btn btn-lg btn-warning m-1"> <i class="fa fa-cart-plus"></i> Add to Cart</button>
            </div>
        </form>
    </div>
    {{--END PRODUCT DETAILS--}}
</div>
{{--END PRODUCT DETAIL ROW--}}
<div class="row">
    <div class="col-md-12 mb-4">
        <p class="mb-4 pl-3">Store Related Products</p>
        <div class="row pl-3 ">

            @foreach($products->store()->first()->products()->paginate(5) as $product) @if(!($products->id == $product->id))
            <div class="col-sm-2">
                <div class="alt-image-container ">
                    <div class="card-head justify-content-center ">
                        <a href="{{route('product.view',$product->id)}}">
                            <img src="{{route('image.get',$product->productpic)}}" alt="" class="img img-responsive"
                                style="height: 100px;">
                        </a>
                    </div>
                    <div class="card-body justify-content-center"><small>
                            <a href="{{route('product.view',$product->id)}}">
                                {{$product->productname}}
                            </a>
                        </small></div>
                </div>
            </div>

            @endif @endforeach
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-md-3 col-sm-1"></div>
    <div class="col-md-6 col-sm-10 border-bottom p-5">
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active just">
                    <img class="d-block w-100" src="{{asset('img/promobg/oyaconstruct-promo-banner.jpg')}}" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('img/promobg/oyaconstruct-promo-banner1.jpg')}}" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('img/promobg/oyaconstruct-promo-banner3.jpg')}}" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="col-md-3 sol-sm-1"></div>
</div>
{{--START REVIEEW--}}
<div class="row">
    <div class="col-md-12 border-bottom">
        <div class="row mt-4 p-2">
            <div class="col-md-4 col-sm-12"></div>
            <div class="col-md-4 col-sm-12">
                <h5>Please kindly leave a review for this product.</h5>
                <div class="form-group">
                    <textarea name="comment" placeholder="What do you think about this product?" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-secondary ">Post</button>
                </div>

            </div>
            <div class="col-md-4 col-sm-12"></div>
        </div>
    </div>
</div>


{{--END REVIEW--}} @endsection @section('script')

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="{{URL::asset('js/popper.min.js')}}"></script>
<script src="{{URL::asset('js/bootstrap.min.js')}}"></script>

<script type="text/javascript">
    function getfeatured() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "GET",
            url: "getfeatured",
            data: {},
            success: function(data) {
                $("#featured-data").append(data.html);

            }
        });
    }

    function getflash() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "GET",
            url: "getdiscount",
            data: {},
            success: function(data) {
                $("#flash-data").append(data.html);

            }
        });
    }

    function getmore(page) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "GET",
            url: "getmore?page=" + page,
            data: {},
            success: function(data) {
                $("#more-data").append(data.html);

            }
        });
    }


    function allcat(service) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            url: "{{URL::to('admin/allcategories')}}",
            data: {
                'service': service,
            },
            success: function(data) {
                var mydata = JSON.parse(data);
                no = mydata.length;
                var i = 0;
                var displaylist = "";
                if (no > 0) {
                    while (i < no) {
                        displaylist += ' <div class="row">';
                        for (var j = 0; j < 4; j++) {
                            if (i >= no) {
                                break;
                            }
                            displaylist += '<div class="col-md-3 list-group list-group-flush">';
                            displaylist += '<a class="list-group-item" href="" onclick=""> ' + mydata[i]['catname'] + ' </a></div>';
                            ++i;
                        }
                        displaylist += '</div>';
                    }
                    document.getElementById('footercat').innerHTML = displaylist;
                }
            }
        });
    }

    $(document).ready(function() {
        $("#back2Top").click(function(event) {
            event.preventDefault();
            $("html, body").animate({
                scrollTop: 0
            }, "slow");
            return false;
        });

        getfeatured();
        getflash();
        allcat('shop');

    });
    /*Scroll to top when arrow up clicked END*/
</script>
<script type="text/javascript">
    var page = 0;
    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= ($(document).height() * 3 / 4)) {
            page++;
            getmore(page);
        }
    });
</script>

<script src="{{URL::to(asset('aurjn/alertify/alertify.min.js'))}}"></script>
<script src="{{URL::to(asset('js/aurjn/devc.js'))}}"></script>
<script src="{{URL::to(asset('js/aurjn/dev.c.lib.js'))}}"></script>
@endsection