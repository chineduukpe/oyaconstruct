@extends('layout')
@section('title')
 Shop products
@endsection

@section('style')
<style type="text/css">
  
  
</style>
 
@endsection

@section('content')

<div class="">
  <div id="">
    <div class="container">
      <div class="row mt-5 align-items-center justify-content-center text-center">
      </div>
       <div class="row mt-5 align-items-center justify-content-center text-center">
        <h1 class="text-center"><strong>Site Under Construction</strong></h1>
        {{$products}}
       
      </div>
    </div>
    <div class="container mt-2 mb-4 text-center text-md-left bg-light">
      <div class="row">
         
      </div>    
    </div>
    <div class="container-fluid mt-2 mb-4 text-center text-md-left bg-light">
      <div class="row">
         
      </div>    
    </div>
    <div class="container-fluid mt-2 mb-4 text-center text-md-left bg-white text-secondary">
      <div class="row">
         <div class="col-lg-12 p-3">
          <h4 class="text-danger text-left mb-4"><span class=""> All Products <strong>Categories</strong></span></h4>
         </div>
      </div>    
      <div class="" id="footercat">

      </div>
    </div>  
    <!-- Footer -->
<footer class="page-footer font-small bg-dark text-white">
  <a href="#" id="back2Top" class="text-white bg-danger" style="position: fixed; right: 2px; bottom: 2px;"><i class="fas fa-arrow-up"></i>Top</a>
  <!--Footer Links-->
<div class="container mt-5 mb-4 text-center text-md-left">
    <div class="row mt-5">

        <!--Second column-->
        <div class="col-md-4 mx-auto mb-4 mt-5">
            <h6 class="text-uppercase font-weight-bold">
                <strong>Pages</strong>
            </h6>
            <hr class="bg-danger accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
            <p>
                <a href="{{URL::to('about')}}">About our company</a>
            </p>
            <p>
                <a href="{{URL::to('contact')}}">Get in touch with us</a>
            </p>
            <p>
                <a href="{{URL::to('faq')}}">FAQ</a>
            </p>
            
            
        </div>
        <!--/.Second column-->

        <!--Third column-->
        <div class="col-md-4 mx-auto mb-4 mt-5">
            <h6 class="text-uppercase font-weight-bold">
                <strong>Important Stuff</strong>
            </h6>
            <hr class="bg-danger accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
            <p><a href="#mySignin" data-toggle="modal">Create store</a></p>
            <p><a href="{{URL::to('termsandprivacy')}}">Terms and conditions</a></p>
            <p><a href="{{URL::to('termsandprivacy')}}">Privacy policy</a></p>
            <p><a href="{{URL::to('termsandprivacy')}}">Return policy</a></p>
        </div>
        <!--/.Third column-->

        <!--Fourth column-->
        <div class="col-md-4 mt-5">
            <h6 class="text-uppercase font-weight-bold">
                <strong>Get in touch with us</strong>
            </h6> <hr class="bg-danger accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
            <p><i class="fas fa-home  mr-3"></i><strong>Plot 590F,</strong> 1025 Adetokunbo Ademola Crescent, Wuse II, Abuja FCT, Nigeria</p>
             <p><i class="fas fa-phone mr-3"></i> (+234) 0803 000 000</p>       
            <p><i class="fas fa-envelope mr-3"></i> info@oyaconstruct.com</p>
        </div>
        <!--/.Fourth column-->

    </div>
</div>
<!--/.Footer Links-->
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2019:
      <a href="#">Oyaconstruct.com</a>
    </div>
    <!-- Copyright -->

  </footer>
  <!-- Footer --> 
  </header>

  </div><!--content-->          
</div><!--wrapper-->

       <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="{{URL::asset('js/popper.min.js')}}"></script>
    <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>

 <script type="text/javascript">
    
  function getfeatured(){
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
                
    $.ajax({
      type: "GET",
      url: "getfeatured",
      data:{
        
      },
      success: function(data){
         $("#featured-data").append(data.html); 
             
      }
  });
}

function getflash(){
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
                
    $.ajax({
      type: "GET",
      url: "getdiscount",
      data:{
        
      },
      success: function(data){
         $("#flash-data").append(data.html); 
             
      }
  });
}

function getmore(page){
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
                
    $.ajax({
      type: "GET",
      url: "getmore?page="+page,
      data:{
        
      },
      success: function(data){
         $("#more-data").append(data.html); 
             
      }
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
      no=mydata.length;
      var i=0;
      var displaylist="";
      if(no>0){
       while(i<no) {
          displaylist+=' <div class="row">';
            for(var j=0; j<4;j++){
              if(i>=no){break;} 
                displaylist+='<div class="col-md-3 list-group list-group-flush">';
                displaylist+='<a class="list-group-item" href="" onclick=""> '+mydata[i]['catname']+' </a></div>';
                ++i;
            }
      displaylist+='</div>';
    }
        document.getElementById('footercat').innerHTML=displaylist;
      }
    }
    });
  }
  $(document).ready(function() {
      $("#back2Top").click(function(event) {
          event.preventDefault();
          $("html, body").animate({ scrollTop: 0 }, "slow");
          return false;
      });

      getfeatured();
      getflash();
      allcat('shop');
  
  });
   /*Scroll to top when arrow up clicked END*/
   </script>
  <script type="text/javascript">
  var page = 0;
  $(window).scroll(function() {
      if($(window).scrollTop() + $(window).height() >= ($(document).height()*3/4)) {
          page++;
          getmore(page);
      }
  });


</script>
</body>

</html>