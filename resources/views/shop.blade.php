@extends('layout')
@section('title')
 Shop products
@endsection

@section('style')
<style type="text/css">
  
  
</style>
 
@endsection

@section('content')

    <section id="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 bg-light p-3 text-secondary">
            <h4 class="text-secondary text-left mb-4"><span class=""><i class="fas fa-tasks"></i> <strong>Categories</strong></span></h4>
            <div id="cat">
              
            </div>
          </div>
          <div class="col-lg-9 bg-light p-3 text-secondary">
          <h4 class="text-secondary text-left mb-4"><span class=""><i class="fas fa-plus-square"></i>Shop <strong>Products</strong></span></h4>
          <div id="post-data" class="">
            @include('moredata')
          </div>
        <div class="ajax-load text-center" style="display:none">
          <p><img src="{{URL::asset('img/lightbox/preloader.gif')}}">Loading More products</p>
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
                  $('.ajax-load').html("No more flash products found");
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
      var displaylist='<div class="list-group list-group-flush">';
  
      for (var i=0; i<mydata.length; i++){
        displaylist+='<a class="list-group-item" href="{{URL::to("prodbycategories?catid=")}}'+mydata[i]['id']+'"><i class="fa fa-angle-right"></i>  '+mydata[i]['catname']+' </a>';
      }
      displaylist+='</div>'
        document.getElementById('cat').innerHTML=displaylist;
      }
    }
    });
  }

  $(document).ready(function(){
    allcat('shop');
   
  });
</script>
@endsection