<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Oyaconstruct - Home of everything construction related</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Shop for construction materials online. Buy and order material. Create your store and have oyaconstruct buy from you." />
  <meta name="author" content="Oyaconstruct" />
    <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ URL::asset('https://use.fontawesome.com/releases/v5.7.0/css/all.css') }}">
  <link href='https://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/mystyle.css') }}">
    <!-- Fav and touch icons -->
<link rel="apple-touch-icon" sizes="57x57" href="{{URL::asset('ico/apple-icon-57x57.png')}}">
<link rel="apple-touch-icon" sizes="60x60" href="{{URL::asset('ico/apple-icon-60x60.png')}}">
<link rel="apple-touch-icon" sizes="72x72" href="{{URL::asset('ico/apple-icon-72x72.png')}}">
<link rel="apple-touch-icon" sizes="76x76" href="{{URL::asset('ico/apple-icon-76x76.png')}}">
<link rel="apple-touch-icon" sizes="114x114" href="{{URL::asset('ico/apple-icon-114x114.png')}}">
<link rel="apple-touch-icon" sizes="120x120" href="{{URL::asset('ico/apple-icon-120x120.png')}}">
<link rel="apple-touch-icon" sizes="144x144" href="{{URL::asset('ico/apple-icon-144x144.png')}}">
<link rel="apple-touch-icon" sizes="152x152" href="{{URL::asset('ico/apple-icon-152x152.png')}}">
<link rel="apple-touch-icon" sizes="180x180" href="{{URL::asset('ico/apple-icon-180x180.png')}}">
<link rel="icon" type="image/png" sizes="192x192"  href="{{URL::asset('ico/android-icon-192x192.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{URL::asset('ico/favicon-32x32.png')}}">
<link rel="icon" type="image/png" sizes="96x96" href="{{URL::asset('ico/favicon-96x96.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{URL::asset('v/favicon-16x16.png')}}">
<link rel="manifest" href="{{URL::asset('ico/manifest.json')}}">
      <!-- JQuery -->
  <script type="text/javascript" src="{{ URL::asset('js/jquery-3.3.1.min.js') }}"></script>
<style type="text/css">
  #form2{
    width: 100%;
  }
  .f2g{
    width: 40%;
  }
  .thumbimg{
  height: 12rem;
  overflow: hidden;
  }
</style>
</head>

<body>

<div class="">
  <div id="">

    <div class="d-flex flex-column flex-md-row align-items-center p-2 bg-white box-shadow fixed-top">
      <h5 class="my-0 mr-md-auto font-weight-normal"><img src="{{URL::asset('img/logo.png')}}" style="height:40px;"></h5>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="btn text-secondary" href="#" > <i class="fa fa-cart-plus"></i> Cart</a>
      @if(Session::get('id')=="")
      <a class="btn text-secondary" href="#mySignin" data-toggle="modal"><i class="fa fa-user"></i>Sign in</a>
      <a class="btn text-secondary" href="#mySignup" data-toggle="modal"><i class="fa fa-register"></i>Sign up</a>
      @endif
      @if(Session::get('id')!="")
      @if(Session::get('role')=="admin" || Session::get('role')=="manager")
      <a class="btn text-secondary" href="{{URL::to('admin/home')}}"><i class="fa fa-user"></i>Dashboard</a>
      @endif
      <a class="btn text-secondary" href="{{URL::to('logout')}}"><i class="fa fa-user"></i>Logout</a>
      @endif
       </nav>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mt-5 p-3">
      <a class="navbar-brand" href="#"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample05">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{URL::to('index')}}">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
            <div class="dropdown-menu" aria-labelledby="dropdown05">
              <a class="dropdown-item" href="{{URL::to('about')}}">About</a>
              <a class="dropdown-item" href="{{URL::to('contact')}}">Contact us</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{URL::to('shop')}}">Shop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Real estate and property</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Professional Services</a>
          </li>
        </ul>
        
      </div>
    </nav>
    <!-- sign up modal-->
    <div class="modal fade" id="mySignup" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
          <div class="modal-header bg-danger text-white">
           <h4 id="mySignupModalLabel">Create an <strong>account</strong></h4> 
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="mySignupform" name="form"  method="post" action="{{URL::to('signup')}}">
            {{ csrf_field() }}
            <div class="form-group">
              <label>Name </label>                    
              <p><strong><small class="text-info">(First name Surname)</small></strong></p>
              <input type="text" id="name" class="form-control" name="name" placeholder="Full name" required="required" autocomplete="off">
            </div>
            <div class="form-group">
              <label>Email </label>                    
              <p><strong><small class="text-info">An email will be sent to verify your account</small></strong></p>
              <input type="email" id="email" name="email" class=" form-control" placeholder="Email"required="required" autocomplete="off">
              <input type="hidden" id="stype" name="stype" value="user">
              <input type="hidden" id="role" name="role" value="user">
            </div>
            <div class="form-group">
              <label>Password </label>                    
              <p><strong><small class="text-info">Password must be 8 characters</small></strong></p>
              <input type="password" id="password" name="password" placeholder="Password" minlength="8" required="required" class="form-control">
            </div>
            <div class="form-group">
              <label>Confirm Password </label>                    
              <input type="password" id="password2" name="password_confirmation" placeholder="Confirm Password" required="required" class="form-control">
            </div>
            <button type="submit" class="btn btn-danger">Signup</button> 
        </form>  
        </div>
        </div>
      </div>
    </div>
<!-- sign up modal-->
  <!-- sign in modal-->
  <div class="modal fade" id="mySignin" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header bg-danger text-white">
         <h4 id="mySignupModalLabel">Login to your <strong>account</strong></h4> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" action="{{URL::to('login')}}">
                {{ csrf_field() }}
                <div class="form-group">
                  <label class="control-label" for="email">Email</label>
                    <input type="email" id="loginemail" name="email" placeholder="Email" required="required" autocomplete="off" class="form-control">
                </div>
                
                <div class="form-group">
                  <label class="control-label" for="password">Password</label>
                    <input type="password" id="loginpassword" name="password" placeholder="Password" minlength="8" required="required" class="form-control">
                </div>
                <div class="form-group">
                
                    <button type="submit" class="btn btn-danger">Login</button>
                  <p class="text-center m-5">
                    Forgot password? <a class="text-danger" href="#myReset" data-dismiss="modal" aria-hidden="true" data-toggle="modal">Reset</a>
                  </p>
                </div>
              </form>
      </div>
      </div>
    </div>
  </div>
<!-- sign in modal-->
<!-- reset modal-->
  <div class="modal fade" id="myReset" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header bg-danger text-white">
         <h4 id="mySignupModalLabel">Reset your <strong>password</strong></h4> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form class="form-horizontal" method="post" action="{{URL::to('resetcode')}}">
          {{ csrf_field() }}
          <div class="form-group">
            <label class="control-label" for="inputResetEmail">Email</label>
              <input type="text" id="inputResetEmail" placeholder="Email" name="email" required="required" class="form-control">
          </div>
          <div class="control-group">
              <button type="submit" class="btn btn-danger">Reset password</button>
            <p class="text-center m-2">
              We will send instructions on how to reset your password to your inbox
            </p>
          </div>
        </form>
      </div>
      </div>
    </div>
  </div>
<!-- sign in modal-->
  <header class="masthead">
    <div class="container">
      <div class="row mt-5 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-center">
          <h1 class="text-uppercase text-white font-weight-bold">Oya construct</h1>
          <hr class="divider my-4">
          <p class="text-white font-weight-light mb-5">Home of everything contruction related.</p>
        </div>
       </div>
       <div class="row mt-2 align-items-center justify-content-center text-center">
       
        <div class="col-lg-12 align-self-center bg-white justify-content-center p-2">
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
          </strong></div>
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
          <form method="get" class="form-inline p-5" action="{{URL::to('prodbycategories')}}" name="form2">
              {{ csrf_field() }}
            <div class="form-group f2g">
              <select class="form-control mr-2" name="catid" style="width: 100%" id="searchcat" required="required">
                <script type="text/javascript">
                    $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                    });
                   $.ajax({
                    type: "GET",
                    url: "{{URL::to('admin/allcategories')}}",
                    data: {
                      'service': 'shop',
                    },
                    success: function(data){
                      var mydata=JSON.parse(data);
                      var displaylist=' <option value="">Select Categories</option>';
                      if(mydata.length>0){
                      for (var i=0; i<mydata.length; i++){
                        displaylist+='<option value="'+mydata[i]['id']+'">'+mydata[i]['catname']+'</option>';
                      }
                      document.getElementById('searchcat').innerHTML=displaylist;
                      }
                    }
                    });
                  </script>
              </select>
            </div>
            <div class="form-group f2g">
            <select class="form-control mr-2" name="state" style="width: 100%">
            <option value="all">All states</option>
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
                 <button type="submit" class="btn btn-danger" style="width: 15%"><i class="fas fa-search"></i> Search</button> 
            </form>

        </div> 
        <div class="col-lg-12 bg-white p-3 text-dark">
          <h4 class="text-secondary text-left mb-4"><span class=""><i class="fas fa-plus-square"></i> Featured <strong>Products</strong></span></h4>
          <div id="featured-data" class="">
          
        </div>

        </div>
      </div>
    </div>
    <div class="container mt-2 mb-4 text-center text-md-left bg-light">
      <div class="row">
         <div class="col-lg-12 p-3">
          <h4 class="text-secondary text-left mb-4"><span class=""><i class="fas fa-bolt"></i> Flash <strong>Sales</strong></span></h4>
          <div id="flash-data" class="">
          
        </div>
         </div>
      </div>    
    </div>
    <div class="container-fluid mt-2 mb-4 text-center text-md-left bg-light">
      <div class="row">
         <div class="col-lg-12 p-3">
          <h4 class="text-secondary text-left mb-4"><span class=""><i class="fas fa-bolt"></i>More <strong>Products</strong></span></h4>
          <div id="more-data" class="">
          
          </div>
         </div>
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
            <p><a href="#">Become a vendor</a></p>
            
        </div>
        <!--/.Second column-->

        <!--Third column-->
        <div class="col-md-4 mx-auto mb-4 mt-5">
            <h6 class="text-uppercase font-weight-bold">
                <strong>Important Stuff</strong>
            </h6>
            <hr class="bg-danger accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
            <p><a href="#">Create store</a></p>
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

  function allcatlayout(service){
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
   $.ajax({
    type: "GET",
    url: "{{URL::to('allcatjson')}}",
    data: {
      'service': service,
    },
    success: function(data){
      //alert(data);
      var mydata=JSON.parse(data);
      no=mydata.length;
      var i=1;
      var displaylist='<ul class="nav nav-pills">';
       while(i<no) {
          subcat=mydata[i]['subcat'];
          subdata="";
          if(subcat.length>1){
          subdata='<ul class="dropdown-menu" id="'+mydata[i]['id']+'" onmouseleave="closesub(\''+mydata[i]['id']+'\')" onmouseenter="displaysub(\''+mydata[i]['id']+'\')">';
          for(var k=0; k<subcat.length; k++){
            subdata+='<li><a class="dropdown-item" href="{{URL::to("prodbycategories?catid=")}}'+mydata[i]['id']+'&subcatid='+subcat[k]['subid']+'">'+subcat[k]['subcat']+'</a> </li>';
          }
          subdata+=' </ul>';
          }
            
            displaylist+='<li class="nav-item dropdown"> <a class="nav-link" href="{{URL::to("prodbycategories?catid=")}}'+mydata[i]['id']+'" onmouseover="displaysub(\''+mydata[i]['id']+'\')"> '+mydata[i]['catname']+' </a>'+subdata+'</li>';
            ++i;
    }
    displaylist+='</ul>';
        document.getElementById('footercat').innerHTML=displaylist;
    }
    });
  }

function displaysub(listid){
  document.getElementById(listid).style.display="block";
}

function closesub(listid){
  document.getElementById(listid).style.display="none";
}

  $(document).ready(function() {
      $("#back2Top").click(function(event) {
          event.preventDefault();
          $("html, body").animate({ scrollTop: 0 }, "slow");
          return false;
      });

      getfeatured();
      getflash();
      allcatlayout('shop');
  
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