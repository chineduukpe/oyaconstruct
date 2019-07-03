@extends('layout') @section('content')
@section('style')
<link rel="stylesheet" href="{{asset('css/aurjn/izitoast.min.css')}}">
<link rel="stylesheet" href="{{asset('css/aurjn/native-circle-loader.css')}}">
<link rel="stylesheet" href="{{asset('css/aurjn/devc.css')}}">
@endsection
<div class="container-fluid mt-3">
    <div class="row">
        <div class=" col-sm-12 col-md-3">
            <div class="card">
                <div class="bg-light border-right shadow-lg" id="sidebar-wrapper">
                    <div class="list-group list-group-flush">
                        <a href="{{route('vendor.settings')}}" class="list-group-item list-group-item-action "><i class="fas fa-cog"></i> My Store Settings</a>
                        <a href="{{route('vendor.products')}}" class="list-group-item list-group-item-action "><i class="fas fa-cart-plus"></i> My Products</a>
                        <a href="#" class="list-group-item list-group-item-action "><i class="fas fa-cart-arrow-down"></i> Customer Orders</a>
                        <a href="#" class="list-group-item list-group-item-action "><i class="fas fa-clone"></i> Request Promo</a>
                        <a href="#" class="list-group-item list-group-item-action "><i class="fas fa-user"></i> Profile</a>
                        <a href="#" class="list-group-item list-group-item-action "><i class="fas fa-circle {{Auth::user()->store->status == 0 ? 'bg-primary' : (Auth::user()->store->status == 1 ? 'bg-success' : 'bg-danger')}}"></i> Status</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-12">
            <div class="card shadow">
                @include('utils.errors') @yield('vendorcontent')
            </div>
        </div>
    </div>
</div>
@endsection @section('script')
 <script type='text/javascript' src="{{asset('js/aurjn/topbar.min.js')}}"></script> 
<script type='text/javascript' src="{{asset('js/aurjn/izitoast.min.js')}}"></script>
<script type='text/javascript' src="{{asset('js/aurjn/dev.c.lib.js')}}"></script>
<script type='text/javascript' src="{{asset('js/aurjn/devc.js')}}"></script>
@endsection