@extends('layout')
@section('title')
 Login
@endsection

@section('style')
<style type="text/css">
  
  
</style>
 
@endsection

@section('content')

    <section id="content">
      <div class="container">
        <div class="row">
          <div class="card col-lg-8">
            <div class="card-body">
              <h4><strong>Sign up</strong></h4>
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
                <form class="form-horizontal" method="post" action="{{URL::to('signup')}}">
                  {{ csrf_field()}}
                  <div class="control-group">
                    <label for="name">Name</label>
                      <p><strong><small class="text-info">(First name Surname)</small></strong></p>
                      <input type="text" id="name" name="name" placeholder="Full name" required="required" autocomplete="off"  class="form-control">
                  </div>
                  <div class="control-group">
                      <p><strong><small class="text-info">An email will be sent to verify your account</small></strong></p>
                      <input type="email" id="email" name="email" placeholder="Email"required="required" autocomplete="off"  class="form-control">
                      <input type="hidden" id="stype" name="stype" value="user">
                      <input type="hidden" id="role" name="role" value="user">
                  </div>
                  
                  <div class="control-group">
                      <p><strong><small class="text-info">Password must be 8 characters</small></strong></p>
                      <input type="password" id="password" name="password" placeholder="Password" minlength="8" required="required"  class="form-control">
                  </div>
                  <div class="control-group">
                    <label for="password2">Confirm Password</label>
                      <input type="password" id="password2" name="password_confirmation" placeholder="Confirm Password" required="required" class="form-control">
                  </div>
                  <div class="control-group">
                      <button type="submit" class="btn btn-danger">Signup</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>  
      </div>
    </section>
@endsection
