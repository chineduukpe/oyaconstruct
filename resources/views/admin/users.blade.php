@extends('../adminlayout')
@section('title')
 {{Session::get('name')}} -Users
@endsection

@section('style')
<style type="text/css">
  
  
</style>
 
@endsection
@section('content')
<section id="content">
  <div class="card-deck">
  <div class="card mt-2">
  @if(session('success'))
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">&times;</button><strong>
     
      <p>{{ session('success') }}</p>
    </strong>
  </div>
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
        </div>
        @endif
        <div class="card-body">
        <h4><strong>Create users </strong></h4>
        <div class="alert alert-info">
        <p>
          <strong>
           As an Oyaconstruct {{Auth::user()->role}}, you use this form to add users that are coming to shop or use other services on the website.
           This user will receive an email of being successfully signup by Oyaconstruct admin and the user must verify his or her email before login.
          </strong>
        </p>
      </div>
        <form class="form-horizontal" method="post" action="{{URL::to('signup')}}">
          {{ csrf_field() }}
          <div class="form-group">
            <label class="control-label" for="name">Name</label>
              <p><strong><small class="text-info">(First name Surname)</small></strong></p>
              <input type="text" id="name" name="name" placeholder="Full name" required="required" autocomplete="off" class="form-control">
          </div>
          <div class="form-group">
            <label class="control-label" for="email">Email</label>
              <p><strong><small class="text-info">An email will be sent to verify to user's account</small></strong></p>
              <input type="email" id="email" name="email" placeholder="Email"  required="required" autocomplete="off" class="form-control">
              <input type="hidden" id="stype" name="stype" value="admin">
          </div>
          
          <div class="form-group">
            <label class="control-label" for="password">Password</label>
              <p><strong><small class="text-info">Password must be 8 characters</small></strong></p>
              <input type="password" id="password" name="password" placeholder="Password" minlength="8" required="required" class="form-control">
          </div>
          <div class="form-group">
            <label class="control-label" for="password2">Confirm Password</label>
            <div class="controls">
              <input type="password" id="password2" name="password_confirmation" placeholder="Confirm Password" required="required" class="form-control">
          </div>
          <div class="form-group">
            <label class="control-label" for="password2">User role</label>
             <select name="role" id="role" required="required" class="form-control">
               <option value="">select</option>
               <option value="user">User</option>
               <option value="vendor">Vendor</option>
               <option value="admin">admin</option>
               <option value="manager">manager</option>
             </select>
          </div>
          <div class="form-group">
              <button type="submit" class="btn btn-danger">Create User</button>
          </div>
        </form>
      </div>
    </div>
  </div>
    <div class="card mt-2">
      <div class="card-body">
        <h2 class="card-title text-center">All Users</h2> 
          <div id="post-data">
            @include('admin/data')
          </div>
          <div class="ajax-load text-center" style="display:none">
          <p><img src="{{URL::asset('img/lightbox/preloader.gif')}}">Loading More users</p>
          </div>
        </div>
      </div>
    </div>
    </section>    
@endsection
@section('script')

<script type="text/javascript">
  var page = 1;
  $(window).scroll(function() {
      if($(window).scrollTop() + $(window).height() >= $(document).height()) {
          page++;
          loadMoreData(page);
      }
  });


  function loadMoreData(page){
    $.ajax(
          {
              url: '?page=' + page,
              type: "get",
              beforeSend: function()
              {
                  $('.ajax-load').show();
              }
          })
          .done(function(data)
          {
              if(data.html == ""){
                  $('.ajax-load').html("No more records found");
                  return;
              }
              $('.ajax-load').hide();
              $("#post-data").append(data.html);
          })
          .fail(function(jqXHR, ajaxOptions, thrownError)
          {
                alert('server not responding...');
          });
  }
</script>

@endsection
