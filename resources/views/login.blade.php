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
          <h4><strong>Login</strong></h4>
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
          </strong>
        </div>
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
                <form class="form-horizontal" method="post" action="{{URL::to('login')}}">
                  {{ csrf_field() }}
                  <div class="control-group">
                    <label  for="email">Email</label>
                      <input type="email" id="email" name="email" placeholder="Email" required="required" autocomplete="off"  class="form-control">
                  </div>
                  
                  <div class="control-group">
                    <label for="password">Password</label>
                      <input type="password" id="password" name="password" placeholder="Password" minlength="8" required="required"  class="form-control">
                  </div>
                  <div class="control-group">
                      <button type="submit" class="btn btn-theme btn-rounded">Login</button>
                  </div>
                </form>
        </div>  
      </div>
    </section>
@endsection
