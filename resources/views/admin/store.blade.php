@extends('../adminlayout')
@section('title')
 {{Session::get('name')}} -Store
@endsection

@section('style')
<style type="text/css">
  
  
</style>
 
@endsection
@section('content')
    <section id="content">
      <div class="card-deck">
        <div class="card p-2">
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
              <h4><strong>Create Store (Fill all fields) </strong></h4>
              <div class="alert alert-info">
              <p>
                <strong>
                 As an Oyaconstruct admin, you use this form to create a store for an owner. The email must correspond to the email used by the owner to signup on Oyaconstruct.
                </strong>
              </p>
            </div>
        <form class="form-horizontal" method="post" action="{{URL::to('admin/createstore')}}">
          {{ csrf_field() }}
          <div class="form-group">
            <label class="control-label" for="name">Store Name</label>
              <p><strong><small class="text-info">(First name, Surname)</small></strong></p>
              <input type="text" id="name" name="name" placeholder="Full name" required="required" autocomplete="off" class="form-control">
          </div>
          <div class="form-group">
            <label class="control-label" for="email">Store Email</label>
              <p><strong><small class="text-info">This can be the owner email</small></strong></p>
              <input type="email" id="email" name="email" placeholder="Email"  required="required" autocomplete="off" class="form-control">
          </div>
          
          <div class="form-group">
            <label class="control-label" for="password">Store phone number</label>
              <p><strong><small class="text-info">This can be the owner phone</small></strong></p>
              <input type="text" id="phone" name="phone" placeholder="e.g 080********" minlength="11" required="required" class="form-control">
          </div>
          <div class="form-group">
            <label class="control-label" for="password2">Store Address</label>
              <textarea name="address" required="required" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label class="control-label" for="password2">State</label>
             <select name="state" id="state" required="required" class="form-control">
               <?php 
                $filecontents = Storage::disk('local')->get('nigerianstatesandlgas.json');
                $array = json_decode($filecontents, true);
                $i = 0;
                for($i=0; $i<count($array); $i++){
                  $state = "";
                  $state = $state.'<option value="'.$array[$i]["state"]["name"].'"';
                  $state = $state.'>';
                  $state = $state.$array[$i]["state"]["name"];
                  $state = $state.'</option>';
                  echo $state;
                }
                
              ?>
             </select>
          </div>
          <div class="form-group">
            <label for="password2">City</label>
            <input type="text" id="city" name="city" required="required" class="form-control">
          </div>
          <div class="form-group">
              <button type="submit" class="btn btn-danger">Create</button>
            
          </div>
        </form>
        </div>
          <div class="card p-2">
            <h2 class="text-center">All Stores</h2>
              <br/>
          <div id="post-data">
            @include('admin/storedata')
          </div>
          <div class="ajax-load text-center" style="display:none">
          <p><img src="{{URL::asset('img/lightbox/preloader.gif')}}">Loading More stores</p>
        </div>
        </div>
      </div>
    </section>    
@endsection
@section('script')
<script type="text/javascript">
  // function allusers(){
  //   $.ajaxSetup({
  //     headers: {
  //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //     }
  //   });
  //  $.ajax({
  //   type: "GET",
  //   url: "{{URL::to('allusers')}}",
  //   data: {
  //     'name': name,
  //   },
  //   success: function(data){
  //   }
  //   });
  // }
</script>

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
