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
            <h4 class="text-secondary text-left mb-4"><span class=""><i class="fas fa-tasks"></i> <strong>Groups</strong></span></h4>
            <div id="cat">
              
            </div>
          </div>
          <div class="col-lg-9 bg-light p-3 text-secondary">
          <h4 class="text-secondary text-left mb-4"><span class=""><i class="fas fa-plus-square"></i> {{$categoryname}} <strong>Products</strong></span></h4>
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
                  $('.ajax-load').html("No more products found");
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

  function allsubcat(catid){
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
      var displaylist='<div class="list-group list-group-flush">';
  
      for (var i=0; i<mydata.length; i++){
        displaylist+='<a class="list-group-item" href="{{URL::to("prodbycategories?catid=")}}'+mydata[i]['catname']+'&subcatid='+mydata[i]['id']+'" ><i class="fa fa-angle-right"></i>  '+mydata[i]['subcat']+' </a>';
      }
      displaylist+='</div>'
        document.getElementById('cat').innerHTML=displaylist;
      }
    }
    });
  }

  // function viewprodbysubcat(catid){
  //     $.ajaxSetup({
  //     headers: {
  //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //     }
  //   });
  //  $.ajax({
  //   type: "GET",
  //   url: "{{URL::to('prodsubcat')}}",
  //   data: {
  //     'subcatid': catid,
  //   },
  //   success: function(data){
  //      document.getElementById("post-data").innerHTML=data.html; 
  //   }
  //   });
  // }

  $(document).ready(function(){
    allsubcat('{{app("request")->input("catid")}}');
   
  });
</script>
@endsection