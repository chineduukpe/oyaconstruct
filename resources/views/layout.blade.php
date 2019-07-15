<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title','Oyaconstruct - Home of everything construction related')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Shop for construction materials online. Buy and order material. Create your store and have oyaconstruct buy from you." />
  <meta name="author" content="Oyaconstruct" />
  @yield('metasection')
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ URL::asset('https://use.fontawesome.com/releases/v5.7.0/css/all.css') }}">
  <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
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
  <link rel="icon" type="image/png" sizes="192x192" href="{{URL::asset('ico/android-icon-192x192.png')}}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{URL::asset('ico/favicon-32x32.png')}}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{URL::asset('ico/favicon-96x96.png')}}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{URL::asset('v/favicon-16x16.png')}}">
  <link rel="manifest" href="{{URL::asset('ico/manifest.json')}}">
  <link rel="manifest" href="{{URL::asset('mdb/css/mdb.min.css')}}">
  <!-- JQuery -->
  <script type="text/javascript" src="{{ URL::asset('js/jquery-3.3.1.min.js') }}"></script>
  <style type="text/css">
    #form2 {
      width: 100%;
    }

    .f2g {
      width: 40%;
    }

    .thumbimg {
      height: 12rem;
      overflow: hidden;
    }
  </style>
  @yield('style')
</head>

<body>

  <div class="wrapper">
    <div id="content">

      <div class="d-flex flex-column flex-md-row align-items-center p-2 bg-white box-shadow fixed-top">
        <h5 class="my-0 mr-md-auto font-weight-normal"><img src="{{URL::asset('img/logo.png')}}" style="height:40px;"></h5>
        <form method="get" class="form-inline" action="{{URL::to('prodbycategories')}}">
          {{ csrf_field() }}
          <div class="form-group">
            <select class="form-control mr-0" name="catid" style="width: 100%" id="searchcat" required="required">
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
                  success: function(data) {
                    var mydata = JSON.parse(data);
                    var displaylist = ' <option value="">Select Categories</option>';
                    if (mydata.length > 0) {
                      for (var i = 0; i < mydata.length; i++) {
                        displaylist += '<option value="' + mydata[i]['id'] + '">' + mydata[i]['catname'] + '</option>';
                      }
                      document.getElementById('searchcat').innerHTML = displaylist;
                    }
                  }
                });
              </script>
            </select>
          </div>
          <div class="form-group">
            <select class="form-control mr-0" name="state" style="width: 100%">
              <option value="all">All states</option>
              <?php
              $filecontents = Storage::disk('local')->get('nigerianstatesandlgas.json');
              $array = json_decode($filecontents, true);
              $i = 0;
              for ($i = 0; $i < count($array); $i++) {
                $state = "";
                $state = $state . '<option value="' . $array[$i]["state"]["name"] . '"';
                $state = $state . '>';
                $state = $state . $array[$i]["state"]["name"];
                $state = $state . '</option>';
                echo $state;
              }

              ?>
            </select>
          </div>
          <button type="submit" class="btn"><i class="fas fa-search"></i></button>
        </form>
        <nav class="my-2 my-md-0 mr-md-3">
          <a class="btn text-secondary" href="{{route('customer.cart.view')}}"> <i class="fa fa-cart-plus">
            </i> Cart
          </a>
          @if(Auth::check())
          @if(empty(Auth::user()->store()->get()->first()) && Auth::user()->role !='user')
          <a class="btn text-secondary" href="#becomeAVendor" data-toggle="modal"><i class="fa fa-triangle"></i>Become a Vendor</a>
          @endif
          @endif
          @if((Auth::guest()))
          <a class="btn text-secondary" href="#becomeAVendor" data-toggle="modal"><i class="fa fa-triangle"></i>Become a Vendor</a>
          <a class="btn text-secondary" href="#mySignin" data-toggle="modal"><i class="fa fa-user"></i>Sign in</a>
          <a class="btn text-secondary" href="#mySignup" data-toggle="modal"><i class="fa fa-register"></i>Sign up</a> @else
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
            @if(Auth::check())
            @if(Auth::user()->role != 'user' && !empty(Auth::user()->store()->get()->first()))
            <li class="nav-item">
              <a class="nav-link" href="{{route('vendor.home')}}">My store</a>
            </li>

            @endif
            @if(Auth::user()->role == 'admin')
            <li class="nav-item">
              <a class="nav-link" href="{{URL::to('/admin/home')}}">Admin</a>
            </li>
            @endif
            @endif
            <li class="nav-item pull-right">
              <a href="{{route('customer.orders.view')}}" class="nav-link">My Orders</a>
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
              <form id="mySignupform" name="form" method="post" action="{{URL::to('signup')}}">
                {{ csrf_field()}}
                <div class="form-group">
                  <label>Name </label>
                  <p><strong><small class="text-info">(First name Surname)</small></strong></p>
                  <input type="text" id="name" class="form-control" name="name" placeholder="Full name" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                  <label>Email </label>
                  <p><strong><small class="text-info">An email will be sent to verify your account</small></strong></p>
                  <input type="email" id="email" name="email" class=" form-control" placeholder="Email" required="required" autocomplete="off">
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
                  <input type="email" id="email" name="email" placeholder="Email" required="required" autocomplete="off" class="form-control">
                </div>

                <div class="form-group">
                  <label class="control-label" for="password">Password</label>
                  <input type="password" id="password" name="password" placeholder="Password" minlength="8" required="required" class="form-control">
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
      <!-- BECOME A VENDOR modal-->
      <div class="modal fade" id="becomeAVendor" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-danger text-white">
              <h4 id="mySignupModalLabel">Become a <strong>Vendor </strong></h4>
              <!-- <p>Create your own store on the go. And start selling instantly!</p> -->
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @if(!Auth::guest())
            <div class="modal-body">
              <form class="form-horizontal" method="post" action="{{route('vendor.create')}}">
                {{ csrf_field() }}
                <div class="form-group">
                  <label class="control-label" for="email">Business Name</label>
                  <input type="text" name="ownername" placeholder="Business Name" required="required" autocomplete="off" class="form-control">
                </div>

                <div class="form-group">
                  <label class="control-label" for="password">Business phone</label>
                  <input type="text" name="ownerphone" placeholder="+2348012345678" minlength="8" required="required" class="form-control">
                </div>
                <div class="form-group">
                  <label class="control-label" for="password">Business Address</label>
                  <textarea name="owneraddress" id="" class="form-control" rows="5" placeholder="No 22 Audu Bolatife Chidiebere Street, Asokoro, FCT."></textarea>
                </div>
                <div class="form-group">
                  <label class="control-label" for="password">State</label>
                  <select class="form-control mr-0" name="state" style="width: 100%">
                    <option value="all">All states</option>
                    <?php
                    $filecontents = Storage::disk('local')->get('nigerianstatesandlgas.json');
                    $array = json_decode($filecontents, true);
                    $i = 0;
                    for ($i = 0; $i < count($array); $i++) {
                      $state = "";
                      $state = $state . '<option value="' . $array[$i]["state"]["name"] . '"';
                      $state = $state . '>';
                      $state = $state . $array[$i]["state"]["name"];
                      $state = $state . '</option>';
                      echo $state;
                    }

                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label class="control-label" for="password">City</label>
                  <input type="text" name="city" placeholder="My City Name" minlength="8" required="required" class="form-control">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-danger">Register</button>
                </div>
              </form>
            </div>
            @else
            <div class="modal-body">
              <p>Steps to becoming a vendor</p>
            </div>
            @endif
          </div>
        </div>
      </div>
      <!-- END BECOME A VENDOR modal-->

      @yield('content')

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
              </h6>
              <hr class="bg-danger accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
              <p><i class="fas fa-home  mr-3"></i><strong>Plot 590F,</strong> 1025 Adetokunbo Ademola Crescent, Wuse II, Abuja
                FCT, Nigeria</p>
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
      <a href="#" id="back2Top" class="scrollup text-danger"><i class="fas fa-arrow-up"></i>Top</a>
    </div>
    <!--content-->
  </div>
  <!--wrapper-->

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->

  <script src="{{URL::asset('js/popper.min.js')}}"></script>
  <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
  <script src="{{URL::asset('mdb/js/mdb.min.js')}}"></script>

  <script type="text/javascript">
    /*Scroll to top when arrow up clicked BEGIN*/
    $(window).scroll(function() {
      var height = $(window).scrollTop();
      if (height > 100) {
        $('#back2Top').fadeIn();
      } else {
        $('#back2Top').fadeOut();
      }
    });

    function allcatlayout(service) {
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
        success: function(data) {
          var mydata = JSON.parse(data);
          no = mydata.length;
          var i = 0;
          var displaylist = "";
          if (no > 0) {
            while (i < no) {
              displaylist += ' <div class="row">';
              for (var j = 0; j < 4; j++) {
                if (i >= no) {
                  break;
                }
                displaylist += '<div class="col-md-3 list-group list-group-flush">';
                displaylist += '<a class="list-group-item" href="" onclick=""> ' + mydata[i]['catname'] + ' </a></div>';
                ++i;
              }
              displaylist += '</div>';
            }
            document.getElementById('footercat').innerHTML = displaylist;
          }
        }
      });
    }

    $(document).ready(function() {
      $("#back2Top").click(function(event) {
        event.preventDefault();
        $("html, body").animate({
          scrollTop: 0
        }, "slow");
        return false;
      });

      allcatlayout('shop');
    });
    /*Scroll to top when arrow up clicked END*/
  </script>
  @yield('script')
</body>

</html>