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
  <h5 class="text-secondary mb-4 mt-5"><span class=""><i class="fas fa-task"></i> Edit <strong>User - {{ $user->name}}</strong></span></h5>
  @if(session('success'))
    <div class="alert alert-success" id="success">
      <button type="button" class="close" data-dismiss="alert">&times;</button><strong>
     
      <p>{{ session('success') }}</p>
    </strong>
  </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger" id="error">
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
        </div>
        @endif
  <div class="card-deck">

  <div class="card">
        <div class="card-body">
        <h4><strong>Personal Details </strong></h4>
        
        <form class="form-horizontal">
          {{ csrf_field() }}
          <div class="form-group">
            <label class="control-label" for="name">Name*</label>
              <input type="text" id="name" name="name" placeholder="Full name" required="required" autocomplete="off" class="form-control" value="{{$user->name}}">
              <input type="hidden" id="userid" name="userid" required="required">
          </div>
          <div class="form-group">
            <label class="control-label" for="email">Date of birth*</label>
              <input type="date" id="dob" name="dob" placeholder="dd-mm-yyyy"  required="required" autocomplete="off" class="form-control" value="{{$user->dob}}">
          </div>
          <div class="form-group">
            <label class="control-label" for="password2">Gender</label>
             <select name="gender" id="gender" class="form-control">
               <option value="">select</option>
               <option value="male" <?php echo ($user->gender=="male")?"selected":"" ?> >Male</option>
               <option value="female" <?php echo ($user->gender=="female")?"selected":"" ?> >Female</option>
             </select>
          </div>
          <div class="form-group">
            <label class="control-label" for="password2">Marital Status</label>
             <select name="mstatus" id="mstatus" class="form-control">
               <option value="">select</option>
               <option value="married" <?php echo ($user->mstatus=="married")?"selected":"" ?> >Married</option>
               <option value="single" <?php echo ($user->mstatus=="single")?"selected":"" ?> >Single</option>
             </select>
          </div>
          <div class="form-group">
            <label class="control-label" for="password">Password (change this only on request from user)</label>
              <p><strong><small class="text-info">Password must be 8 characters </small></strong></p>
              <input type="password" id="password" name="password" placeholder="Password" minlength="8" class="form-control">
          </div>
          <div class="form-group">
            <label class="control-label" for="password2">Confirm Password</label>
              <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" class="form-control">
              <p id="passwordmsg" class="texe-read"></p>
          </div>
          @if(Session::get('role')=='admin')
          <div class="form-group">
            <label class="control-label" for="password2">User role*</label>
             <select name="role" id="role" required="required" class="form-control">
               <option value="">select</option>
               <option value="user"  <?php echo ($user->role=="user")?"selected":"" ?> >User</option>
               <option value="vendor"  <?php echo ($user->role=="vendor")?"selected":"" ?>>Vendor</option>
               <option value="admin"  <?php echo ($user->role=="admin")?"selected":"" ?>>Admin</option>
               <option value="manager"  <?php echo ($user->role=="manager")?"selected":"" ?> >Manager</option>
             </select>
          </div>
          @endif
           @if(Session::get('role')!='admin')
          <div class="form-group">
            <label class="control-label" for="password2">User role*</label>
             <select name="role" id="role" required="required" class="form-control" readonly="readonly">
               <option value="">select</option>
              <option value="user"  <?php echo ($user->role=="user")?"selected":"" ?> >User</option>
               <option value="vendor"  <?php echo ($user->role=="vendor")?"selected":"" ?>>Vendor</option>
               <option value="admin"  <?php echo ($user->role=="admin")?"selected":"" ?>>Admin</option>
               <option value="manager"  <?php echo ($user->role=="manager")?"selected":"" ?> >Manager</option>
             </select>
          </div>
          @endif
          <div class="ajax-load text-center" style="display:none">
            <p><img src="{{URL::asset('img/lightbox/preloader.gif')}}"></p>
          
          </div>
            <p id="message"></p>
          <div class="form-group">
              <button type="button" class="btn btn-danger" id="btn1">Update</button>
          </div>
        </form>
      </div>
    </div>

    <div class="card mt-2">
      <div class="card-body">
        <h6 class="card-title text-center">Contact Details</h6>
                <form class="form-horizontal">
          {{ csrf_field() }}
          <div class="form-group">
            <label class="control-label" for="name">Address*</label>
              <textarea id="address" name="address" placeholder="Current location" required="required" autocomplete="off" class="form-control" > {{$user->address}} </textarea>
          </div>
          <div class="form-group">
            <label class="control-label" for="email">Phone*</label>
              <input type="text" id="phone" name="phone" placeholder="Phone number"  required="required" autocomplete="off" class="form-control" value="{{$user->phone}}">
          </div>
          
          <div class="form-group">
            <label class="control-label" for="password2">State*</label>
             <select name="state" id="state" class="form-control" required="required">
               <?php 
                $filecontents = Storage::disk('local')->get('nigerianstatesandlgas.json');
                $array = json_decode($filecontents, true);
                $i = 0;
                for($i=0; $i<count($array); $i++){
                  $sel=($user->state==$array[$i]["state"]["name"])?"selected":"";
                  $state = "";
                  $state = $state.'<option value="'.$array[$i]["state"]["name"].'"';
                  $state = $state.' '.$sel.'>';
                  $state = $state.$array[$i]["state"]["name"];
                  $state = $state.'</option>';
                  echo $state;
                }
                
              ?>
             </select>
          </div>
          <div class="form-group">
            <label for="password2">City</label>
             <input type="text" id="city" name="city" value="{{$user->lga}}" class="form-control">
          </div>
          <div class="ajax-load2 text-center" style="display:none">
            <p><img src="{{URL::asset('img/lightbox/preloader.gif')}}"></p>
            
          </div>
          <p id="message2"></p>
          <div class="form-group">
              <button type="button" class="btn btn-danger" id="btn2">Update</button>
          </div>
        </form> 
          
        </div>
      </div>
    </div>
    
    </section>    
@endsection
@section('script')
<script type="text/javascript">
function submitpersonal(){
  $('.ajax-load').show();
  var name=document.getElementById('name').value;
  var dob=document.getElementById('dob').value;
  var gender=document.getElementById('gender').value;
  var mstatus=document.getElementById('mstatus').value;
  var password=document.getElementById('password').value;
  var role=document.getElementById('role').value;
  var userid="{{$user->id}}";
  var password_confirmation=document.getElementById('password_confirmation').value;
  if(name.length<3){
    $('#message').html('<span>Please provide a valid name</span>');
    $('.ajax-load').hide();
  }else if(dob==""){
    $('#message').html('<span>Please provide a valid date of birth</span>');
    $('.ajax-load').hide();
  }else if(role==""){
    $('#message').html('<span>Please select a role</span>');
    $('.ajax-load').hide();
  }else if(password.length>0 && password.length<8){
    $('#passwordmsg').html('<span>Password must be 8 characters</span>');
    $('.ajax-load').hide();
  }else if(password.length>0 && password!=password_confirmation){
    $('#passwordmsg').html('<span>Passwords do not match</span>');
    $('.ajax-load').hide();
  }else{ 
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
   $.ajax({
    type: "GET",
    url: "{{URL::to('admin/updateuser')}}",
    data: {
      'name': name,
      'dob': dob,
      'gender': gender,
      'mstatus': mstatus,
      'password': password,
      'role': role,
      'id':userid,
      'updatetype':1,
    },
    success: function(data){
      $('.ajax-load').hide();
      if(data.error=="1"){
        $('#message').html('<span>An error was encountered. Please try again.</span>');
      }
      if(data.success=="1"){
       $('#message').html('<span>Personal details updated</span>');
        refresh(5000);
      }
    }
    });
 }
}

function submitcontact(){
  $('.ajax-load2').show();
  var address=document.getElementById('address').value;
  var phone=document.getElementById('phone').value;
  var state=document.getElementById('state').value;
  var city=document.getElementById('city').value;
    var userid="{{$user->id}}";
  if(phone.length<11 || phone.length>14){
    $('#message2').html('<span>Please provide a valid phone number</span>');
    $('.ajax-load2').hide();
  }else if(state==""){
    $('#message2').html('<span>Please select a state</span>');
    $('.ajax-load2').hide();
  }else if(address.length<5){
    $('#message2').html('<span>Please provide a valid address</span>');
    $('.ajax-load2').hide();
  }else{ 
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
   $.ajax({
    type: "GET",
    url: "{{URL::to('admin/updateuser')}}",
    data: {
      'address': address,
      'state': state,
      'phone': phone,
      'city': city,
      'id':userid,
      'updatetype':2,
    },
    success: function(data){
      $('.ajax-load2').hide();
      if(data.error=="1"){
        $('#message2').html('<span>An error was encountered. Please try again.</span>');
      }
      if(data.success=="1"){
       $('#message2').html('<span>Contact details updated</span>');
        refresh(5000);
      }
    }
    });
 }
}

function refresh(timeoutPeriod){
  setTimeout("location.reload(true);",timeoutPeriod);
}

$(document).ready(function(){
   $('#btn1').click(function(){
      submitpersonal();
  });
   $('#btn2').click(function(){
      submitcontact();
  });
});
</script>


@endsection
