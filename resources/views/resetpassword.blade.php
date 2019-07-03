@extends('layout')
@section('title')
 Reset Password
@endsection

@section('style')
<style type="text/css">
  
  
</style>
 
@endsection

@section('content')

    <section id="inner-headline">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="inner-heading">
              <h2>Reset Password</h2>
            </div>
          </div>
          <div class="col-lg-8">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{URL::to('index')}}"><i class="fas  fa-home"></i></a></li>
              <li class=" breadcrumb-item active">Reset Password</li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <section id="content">
      <div class="container">
        <div class="row">
          @if(session('success'))
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>
           
            <p>{{ session('success') }}</p>
          </strong></div>
          @endif
          @if(session('error'))
          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button><strong>
           
            <p>{{ session('error') }}</p>
          </strong></div>
          @endif
           @if($errors->any())
              <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>
                @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
              </strong></div>
              @endif                  
                <form class="form-horizontal" method="get" action="{{URl::to('resetpassword')}}">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label class="control-label" for="email">Password reset code</label>
                      <p><strong><small class="text-info">An password reset code has been sent to your email</small></strong></p>
                      <input type="password" id="code" name="code" placeholder="Reset code" required="required" autocomplete="off" class="form-control">
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label" for="password">Password</label>
                      <p><strong><small class="text-info">Password must be 8 characters</small></strong></p>
                      <input type="password" id="password" name="password" placeholder="Password" minlength="8" required="required" class="form-control">
                  </div>
                  <div class="form-group">
                    <label class="control-label" for="password2">Confirm Password</label>
                      <input type="password" id="password2" name="password_confirmation" placeholder="Confirm Password" required="required" class="form-control">
                  
                  </div>
                  <div class="control-group">
                      <button type="submit" class="btn btn-danger">Reset</button>
                  </div>
                </form>
        </div>  
      </div>
    </section>
@endsection
