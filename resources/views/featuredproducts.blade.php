@extends('layout')
@section('title')
 Featured products
@endsection

@section('style')
<style type="text/css">
  
  
</style>
 
@endsection

@section('content')

    <section id="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 bg-white p-3 text-dark">
          <h4 class="text-secondary text-left mb-4"><span class=""><i class="fas fa-plus-square"></i> Featured <strong>Products</strong></span></h4>
          <div id="post-data" class="">
            @include('featuredproductsdata')
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
                  $('.ajax-load').html("No more featured products found");
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