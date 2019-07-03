@extends('vendor.vendorlayout')

@section('vendorcontent')
<div id="page-content-wrapper shadow-lg">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          Welcome Back <strong> {{Auth::user()->name}}</strong>
        </div>
      </nav>

      <div class="container-fluid">
        <h1 class="mt-4"> </h1>
        <p>Here is your store dashboard. Your can manage your store here. Click on any link on the left to get started!</p>
      </div>
    </div>
@endsection