@extends('vendor.vendorlayout') @section('vendorcontent')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row p-5">
            <!--MY PRODUCTS  -->
            <div class="col-md-8 col-sm-12">
                <h4><strong>My Products </strong></h4>
                <div class="row" id="productViewURLContainer" data-location="{{route('api.vendor.products.single','')}}">
                    @if($products)
                    <!-- <div class="col-md-4 col-sm-6 col-lg-3">
                        <div class="card-naked">
                            <div class="view overlay hm-white-slight rounded mb-4">
                                <a href="#vendorProductDetail" data-toggle='modal' id="$product->id">
                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                   </button> 
                                    <img src="URL::to('product/storage/').'/'.$product->productpic" style="width:100%; height: 100%" alt="">
                                </a>
                            </div>
                            <h6 class="mb-3">
                                <a href="#"><span class="badge purple mr-1"></span></a>
                            </h6>
                            <h5 class="mb-3">
                                <small> <strong>$product->productname</strong></small>
                            </h5>
                            <p>
                                <span class="mr-1 text-center .badge badge-danger badge-pill">$product->price</span>
                            </p>
                        </div>
                    </div> -->

                    <ul class="list-group col-md-12">
                        @foreach($products as $product)
                        <a href="#vendorProductDetail" product-id="{{$product->id}}" data-toggle='modal' class="row list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div class="flex-column col-md-6 bold">
                                {{$product->productname}}
                                <p><small>{{str_limit($product->shortdesc,200,'...')}}</small></p>
                                <span class="badge {{$product->quantity == 0 ? 'badge-danger' : 'badge-danger'}} badge-pill"> <i>{{$product->quantity}}</i> in Stock</span>
                            </div>
                            <div class="image-parent col-md-6">
                                <img src="{{asset('product/storage/').'/'.$product->productpic}}" class="img-fluid img-respsonsive" alt="quixote">
                            </div>
                        </a>
                        @endforeach
                        <li class="links mt-3">
                            {{$products->links()}}
                        </li>
                    </ul>
                    <!-- <table class="table table-responsive table-bordereless table-striped">
                        <thead>
                            <tr>
                                <td>Product Name</td>
                                <td>Available Quantity</td>
                                <td colspan="">Price</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr class="bb-1" href="#vendorProductDetail" product-id="{{$product->id}}" data-toggle='modal'>
                                <td>{{$product->productname}}</td>
                                <td class="quantity">{{$product->quantity}}</td>
                                <td>{{$product->price}}</td>
                                <td>
                                    <a href="#vendorProductDetail" data-toggle='modal' product-id="{{$product->id}}"><i class="fa fa-edit fa-primary"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Product Name</td>
                                <td>Available Quantity</td>
                                <td>Price</td>
                            </tr>
                        </tfoot>
                    </table> -->
                    @else
                    <div class="col-md-12">
                        <p>{{__('store.store-empty')}}</p>
                    </div>
                    @endif
                </div>

                <!-- {{$products->links()}} -->
            </div>
            <!--END MY PRODUCTS  -->
            <!--LATEST PRODUCTS  -->
            <div class="col-md-4 col-sm-12">
                <div class="card shadow-sm">
                    <div class="card-head text-center mt-3">
                        <h5>New Products</h5>
                    </div>
                    <div class="card-body">
                        <div id="post-data">
                            <div class="card-body text-muted">
                                <h5 class="pb-3 mb-0 border-bottom border-danger">1. <a href='#'>Product Title </a></h5>
                                <ul class="list-unstyled">
                                    <li><span></span> <span>Available Quantity</span></li>
                                    <li><span>Product Desctipyion</span></li>
                                    <li><span>Abuja</span>, <span>FCT</span></li>
                                </ul>
                                <div class="justify-content-center align-items-center">
                                    <div></div>
                                    <div class="dropdown show dropleft">
                                        <a href='#'><button class="btn btn-danger mb-1" >View product</button></a>
                                        <a class="btn btn-danger dropdown-toggle mb-1" href="#" role="button" id="1" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
									View more
								</a>

                                        <div class="dropdown-menu" aria-labelledby="1">
                                            <h6><a class="dropdown-header" href='#'>OyaConstruct.com-Edit</a></h6>
                                            <div class="px-4 py-3">
                                                <ul class="list-unstyled">
                                                    <li>
                                                        <hr style="margin-top:3px;">
                                                    </li>
                                                    <li>
                                                        Id Card Number: 6789076543
                                                    </li>
                                                    <li>
                                                        Id Card Type: national id
                                                    </li>
                                                    <li>
                                                        Date Approved 01-01-1970
                                                    </li>

                                                    <li>
                                                        Approved by: 23
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--END LATEST PRODUCTS  -->

        </div>
    </div>
    <!-- Product Description modal-->
    <div class="modal fade" id="vendorProductDetail" tabindex="-1" role="dialog" aria-labelledby="vendor" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h4 id="productDescriptionLabel" class="productDescriptionLabel">Product Name <strong>Here</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Enter an amount to add. Please enter a negative value to reduce product quantity.</p>
                    <form action="{{route('api.vendor.products.update.quantity')}}" id="vendorUpdateQuantity" method="POST">
                        <input type="hidden" name="producttoupdate" />
                        <input type="number" name="amount" placeholder="incremental (eg: 10)" />
                        <button type="submit" class="btn btn-sm btn-danger">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product  Description modal-->
</div>
@endsection