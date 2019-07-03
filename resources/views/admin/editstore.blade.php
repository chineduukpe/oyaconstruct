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
  <h5 class="text-secondary mb-4 mt-5"><span class=""><i class="fas fa-task"></i> Edit <strong>Store - {{ $store->ownername}}</strong></span></h5>
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
        <h4><strong>Store Details </strong></h4>
        
        <form class="form-horizontal">
          {{ csrf_field() }}
          <div class="form-group">
            <label class="control-label" for="name">Store Name*</label>
              <input type="text" id="name" name="name" placeholder="Full name" required="required" autocomplete="off" class="form-control" value="{{$store->ownername}}">
          </div>
          <div class="form-group">
            <label class="control-label" for="email">Store Email*</label>
              <input type="email" id="email" name="email" placeholder="dd-mm-yyyy"  required="required" autocomplete="off" class="form-control" value="{{$store->owneremail}}">
          </div>
          <div class="form-group">
            <label class="control-label" for="name">Store Address*</label>
              <textarea id="address" name="address" placeholder="Current location" required="required" autocomplete="off" class="form-control" > {{$store->owneraddress}} </textarea>
          </div>
          <div class="form-group">
            <label class="control-label" for="email">Store Phone*</label>
              <input type="text" id="phone" name="phone" placeholder="phone number"  required="required" autocomplete="off" class="form-control" value="{{$store->ownerphone}}">
          </div>
          
          <div class="form-group">
            <label class="control-label" for="password2">State*</label>
             <select name="state" id="state" class="form-control" required="required">
               <?php 
                $filecontents = Storage::disk('local')->get('nigerianstatesandlgas.json');
                $array = json_decode($filecontents, true);
                $i = 0;
                for($i=0; $i<count($array); $i++){
                  $sel=($store->state==$array[$i]["state"]["name"])?"selected":"";
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
            <label for="password2">City*</label>
             <input type="text" id="city" name="city" value="{{$store->city}}" class="form-control">
          </div>
          <div class="form-group">
            <label class="control-label" for="password2">Id Card Type*</label>
             <select name="idcardtype" id="idcardtype" class="form-control">
               <option value="">select</option>
               <option value="national id" <?php echo ($store->idcardtype=="national id")?"selected":"" ?> >National ID</option>
               <option value="driver liscence" <?php echo ($store->idcardtype=="driver liscence")?"selected":"" ?> >Driver's Liscence</option>
               <option value="voter card" <?php echo ($store->idcardtype=="voter card")?"selected":"" ?> >Voter's card</option>
               <option value="international Passport" <?php echo ($store->idcardtype=="international Passport")?"selected":"" ?> >International Passport</option>
             </select>
          </div>
          <div class="form-group">
            <label for="password2">ID card number*</label>
             <input type="text" id="idcardno" name="idcardno" value="{{$store->idcardno}}" class="form-control">
          </div>
          @if(Session::get('role')=='admin')
          <div class="form-group">
            <label class="control-label" for="password2">Set status as *</label>
             <select name="status" id="status" required="required" class="form-control">
               <option value="1"  <?php echo ($store->status==1)?"selected":"" ?> >Approved/Active</option>
               <option value="0"  <?php echo ($store->status==0)?"selected":"" ?>>New</option>
               <option value="2"  <?php echo ($store->status==2)?"selected":"" ?>>Inactive</option>
             </select>
          </div>
          @endif
           @if(Session::get('role')!='admin')
          <div class="form-group">
            <label class="control-label" for="password2">Approved*</label>
             <select name="status" id="status" required="required" class="form-control">
               <option value="1"  <?php echo ($store->status==1)?"selected":"" ?> >Approved/Active</option>
               <option value="0"  <?php echo ($store->status==0)?"selected":"" ?>>New</option>
               <option value="2"  <?php echo ($store->status==2)?"selected":"" ?>>Inactive</option>
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

    </div>
    
    </section>    
@endsection
@section('script')
<script type="text/javascript">
function submitpersonal(){
  $('.ajax-load').show();
  var name=document.getElementById('name').value;
  var email=document.getElementById('email').value;
  var phone=document.getElementById('phone').value;
  var address=document.getElementById('address').value;
  var state=document.getElementById('state').value;
  var city=document.getElementById('city').value;
  var idcardno=document.getElementById('idcardno').value;
  var idcardtype=document.getElementById('idcardtype').value;
  var id="{{$store->id}}";
  var stat=document.getElementById('status').value;
  if(name.length<3){
    $('#message').html('<span>Please provide a valid name</span>');
    $('.ajax-load').hide();
  }else if(email==""){
    $('#message').html('<span>Please provide a valid email</span>');
    $('.ajax-load').hide();
  }else if(phone.length<11 || phone.length>14){
    $('#message').html('<span>Please provide a valid phone number</span>');
    $('.ajax-load').hide();
  }else if(state==""){
    $('#message').html('<span>Please select a state</span>');
    $('.ajax-load').hide();
  }else if(address.length<5){
    $('#message').html('<span>Please provide a valid address</span>');
    $('.ajax-load').hide();  
  }else if(city==""){
    $('#message').html('<span>Please provide a state</span>');
    $('.ajax-load').hide();
  }else if(idcardtype==""){
    $('#message').html('<span>Please select an id card type</span>');
    $('.ajax-load').hide();
  }else if(idcardno.length<7){
    $('#message').html('<span>Please provide a valid id card number</span>');
    $('.ajax-load').hide();
  }else{ 
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
   $.ajax({
    type: "GET",
    url: "{{URL::to('admin/updatestore')}}",
    data: {
      'name': name,
      'email': email,
      'phone': phone,
      'address': address,
      'city': city,
      'idcardno': idcardno,
      'idcardtype': idcardtype,
      'state': state,
      'status': stat,
      'id':id,
      'updatetype':1,
    },
    success: function(data){
      $('.ajax-load').hide();
      if(data.error=="1"){
        $('#message').html('<span>An error was encountered. Please try again.</span>');
      }
      if(data.success=="1"){
       $('#message').html('<span>Store updated Successfully</span>');
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
   
});
</script>


@endsection
