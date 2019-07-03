@extends('../adminlayout')
@section('title')
 {{Session::get('name')}} -Category
@endsection

@section('style')
<style type="text/css">
  
  
</style>
 
@endsection
@section('content')

    <section id="content">
      <div class="card">
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
              <h4><strong>Add Category </strong></h4>
              <div class="alert alert-info">
              <p>
                <strong>
                  Add different categories for Shop, real estate and property, and professional services
                </strong>
              </p>
            </div>
        <form class="form-horizontal" method="post" action="{{URL::to('admin/addcategory')}}">
          {{ csrf_field() }}
          <div class="form-group">
            <label class="control-label" for="inputservice">Service Type</label>
              <select id="service" name="service" required="required" class="form-control">
              <option value="">Select</option>
              <option value="shop">Shop</option>
              <option value="real estate">Real Estate and Property</option>
              <option value="professional services">Professional Services</option>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label" for="catname">Category Name</label>
              <input type="text" id="catname" name="catname" placeholder="name"  required="required" autocomplete="off" class="form-control">
          </div>
          <div class="form-group">
              <button type="submit" class="btn btn-danger">Add</button>
          </div>
        </form>
      </div>

        <div class="card" id="allcat">
          
        </div>
    </section>    
@endsection
@section('script')
<script type="text/javascript">
  function allcat(service){
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
   $.ajax({
    type: "GET",
    url: "{{URL::to('admin/allcategories')}}",
    data: {
      'service': service,
    },
    success: function(data){
      var mydata=JSON.parse(data);
      //alert(service);
      if(mydata.length>0){
      var displaylist='<div class="card-header"><h3>CAREGORIES UNDER <strong>'+service.toUpperCase()+'</strong></h3></div><div class="card-body"><br><ol class="list-group">';
      for (var i=0; i<mydata.length; i++){
        displaylist+='<li class="list-group-item"><p><span class="badge badge-pill badge-danger"><i class="fas fa-arrow-right"></i></span><strong>'+mydata[i]['catname']+'</strong> <span class="btn btn-sm btn-info" onclick="viewsubcategory(\''+mydata[i]['id']+'\')">View subcategory<i class="icon-angle-down"></i></span> <span class="btn btn-sm btn-info" onclick="daddsubcategory(\''+mydata[i]['id']+'\')">Add sub category<i class="icon-angle-down"></i></span> <span class="btn btn-sm btn-info" onclick="deditcategory(\''+mydata[i]['id']+'\',\''+mydata[i]['servicetype']+'\')">Edit<i class="icon-angle-down"></i></span></p><div id="'+mydata[i]['id']+'"></div></li>';
      }
        displaylist+='</ol></div></div>';
        document.getElementById('allcat').innerHTML=displaylist;
      }
    }
    });
  }
function viewsubcategory(catid){
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
   $.ajax({
    type: "GET",
    url: "{{URL::to('admin/viewsubcat')}}",
    data: {
      'catid': catid,
    },
    success: function(data){
      var mydata=JSON.parse(data);
      if(mydata.length>0){
      var displaylist='<div class="pricing-box-alt"><ol>';
      for (var i=0; i<mydata.length; i++){
        displaylist+='<li>'+mydata[i]['subcat']+'  <span class="btn btn-sm btn-link" onclick="deditcategory(\''+mydata[i]['id']+'\')">Edit<i class="icon-angle-down"></i></span></li>';
      }
        displaylist+='</ol>';
        document.getElementById(catid).innerHTML=displaylist;
      }
    }
    });
}

function daddsubcategory(catid){
  var displaylist='<form class="form-inline"><div class="form-group"><input type="text" id="subcategory" name="subcategory" placeholder="Sub category name" minlength="4" required="required" class="form-control"><button class="btn btn-sm btn-info" onclick="addsub(\''+catid+'\')">Add sub category</button></div></form>';
  document.getElementById(catid).innerHTML=displaylist;
}

function addsub(catid){
  subcat=document.getElementById('subcategory').value;
  if(subcat==""){
    alert('Provide a sub category name');
  }else{
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
   $.ajax({
    type: "GET",
    url: "{{URL::to('admin/addsubcat')}}",
    data: {
      'catid': catid,
       'subcat': subcat, 
    },
    success: function(data){
        if(data.success==1){ alert('Sub category added');}
        else if(data.error!=""){ alert(data.error);}
        viewsubcategory(catid);
      }
    
    });
 }
}

function editcat(catid,service){
  cat=document.getElementById('editcategory').value;
  if(cat==""){
    alert('Provide a category name');
  }else{
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
   $.ajax({
    type: "GET",
    url: "{{URL::to('admin/editcat')}}",
    data: {
      'catid': catid,
       'cat': cat, 
    },
    success: function(data){
        if(data.success==1){ alert('Category edited');}
        else if(data.error!=""){ alert(data.error);}
        allcat(service);
      }
    
    });
 }
}


function deditcategory(catid,service){
  var displaylist='<form class="form-inline"><div class="form-group"><input type="text" id="editcategory" name="editcategory" placeholder="category name" minlength="4" required="required" class="form-control"><button type="button" class="btn btn-sm btn-info" onclick="editcat(\''+catid+'\',\''+service+'\')">Edit</button></div></form>';
  document.getElementById(catid).innerHTML=displaylist;
}
$(document).ready(function(){
   $('#service').change(function(){
      var selectedServe = document.getElementById('service').value;
      allcat(selectedServe);
  });      
});
</script>


@endsection
