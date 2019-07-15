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
  <meta name="csrf-token" content="{{csrf_token()}}" />
    <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ URL::asset('https://use.fontawesome.com/releases/v5.7.0/css/all.css') }}">
  <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/mystyle.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/sidebar.css') }}">
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
<link rel="manifest" href="{{URL::asset('css/aurjn/izitoast.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
      <!-- JQuery -->
  <script type="text/javascript" src="{{ URL::asset('js/jquery-3.3.1.min.js') }}"></script>
<style type="text/css">
  #form2{
    width: 100%;
  }
  .f2g{
    width: 40%;
  }
  
</style>
@yield('style')
</head>

<body>

<div class="page-wrapper chiller-theme toggled">
  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>X
  </a>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <a href="#">Menu</a>
        <div id="close-sidebar">
          <i class="fas fa-times"></i>
        </div>
      </div>
      <div class="sidebar-header">
        <div class="user-pic">
          <img class="img-responsive img-rounded" src="{{URL::asset('img/lightbox/avatar.png')}}"
            alt="User picture">
        </div>
        <div class="user-info">
          <span class="user-name"><strong>{{Session::get('name')}}</strong>
          </span>
          <span class="user-role">{{ucfirst(Auth::user()->role)}}</span>
          <span class="user-status">
            <i class="fa fa-circle"></i>
            <span>Online</span>
          </span>
        </div>
      </div>
      
      <div class="sidebar-menu">
        <ul>
          <li class="header-menu">
            <span>Admin</span>
          </li>
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fa fa-users"></i>
              <span>Users</span>
              <span class="badge badge-pill badge-warning">New</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="{{URL::to('admin/users')}}">
                    Create User
                    <span class="badge badge-pill badge-success">+</span>
                  </a>
                </li>
                <li>
                  <a href="{{URL::to('admin/users')}}">View Users
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fa fa-tasks"></i>
              <span>Category</span>
              <span class="badge badge-pill badge-warning">Add</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="{{URL::to('admin/category')}}">
                    Create Category
                    <span class="badge badge-pill badge-success">+</span>
                  </a>
                </li>
                <li>
                  <a href="{{URL::to('admin/category')}}">View Category
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fa fa-store"></i>
              <span>Store</span>
              <span class="badge badge-pill badge-warning">New</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="{{URL::to('admin/store')}}">
                    Create Store
                    <span class="badge badge-pill badge-success">+</span>
                  </a>
                </li>
                <li>
                  <a href="{{URL::to('admin/store')}}">View Store
                  </a>
                </li>
              </ul>
            </div>
          </li>
           <li class="sidebar-dropdown">
            <a href="#">
              <i class="fa fa-store"></i>
              <span>Product Props</span>
              <span class="badge badge-pill badge-warning">New</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="{{route('admin.colours')}}">
                    Color
                  </a>
                </li>
                <li>
                  <a href="{{route('admin.sizes')}}">Size
                  </a>
                </li>
              </ul>
            </div>
          </li>

          <!-- ORDERS -->
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fa fa-store"></i>
              <span>Orders</span>
              <span class="badge badge-pill badge-warning">New</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="{{route('admin.orders.view')}}">
                    View Orders
                  </a>
                </li>
              </ul>
            </div>
          </li>
          
          <!-- <li class="sidebar-dropdown">
            <a href="#">
              <i class="fa fa-shopping-cart"></i>
              <span>E-commerce</span>
              <span class="badge badge-pill badge-danger">3</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="#">Products

                  </a>
                </li>
                <li>
                  <a href="#">Orders</a>
                </li>
                <li>
                  <a href="#">Credit cart</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="far fa-gem"></i>
              <span>Components</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="#">General</a>
                </li>
                <li>
                  <a href="#">Panels</a>
                </li>
                <li>
                  <a href="#">Tables</a>
                </li>
                <li>
                  <a href="#">Icons</a>
                </li>
                <li>
                  <a href="#">Forms</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fa fa-chart-line"></i>
              <span>Charts</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="#">Pie chart</a>
                </li>
                <li>
                  <a href="#">Line chart</a>
                </li>
                <li>
                  <a href="#">Bar chart</a>
                </li>
                <li>
                  <a href="#">Histogram</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fa fa-globe"></i>
              <span>Maps</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="#">Google maps</a>
                </li>
                <li>
                  <a href="#">Open street map</a>
                </li>
              </ul>
            </div>
          </li> -->
         <!--  <li class="header-menu">
            <span>Extra</span>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-book"></i>
              <span>Documentation</span>
              <span class="badge badge-pill badge-primary">Beta</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-calendar"></i>
              <span>Calendar</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-folder"></i>
              <span>Examples</span>
            </a>
          </li> -->
        </ul>
      </div>
      <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->
    <div class="sidebar-footer">
      <a href="#">
        <i class="fa fa-bell"></i>
        <span class="badge badge-pill badge-warning notification">3</span>
      </a>
      <a href="#">
        <i class="fa fa-envelope"></i>
        <span class="badge badge-pill badge-success notification">7</span>
      </a>
      <a href="#">
        <i class="fa fa-cog"></i>
        <span class="badge-sonar"></span>
      </a>
      <a href="#">
        <i class="fa fa-power-off"></i>
      </a>
    </div>
  </nav>
  <!-- sidebar-wrapper  -->
  <main class="page-content">
    <div class="container-fluid">
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white box-shadow">
      <h5 class="my-0 mr-md-auto font-weight-normal"><img src="{{URL::asset('img/logo.png')}}" style="height:40px;"></h5>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-danger" href="{{URL::to('logout')}}"><i class="fas fa-user"></i>Logout</a>
      </nav>
      
    </div>
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample05">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{URL::to('admin/home')}}">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Store</a>
            <div class="dropdown-menu" aria-labelledby="dropdown03">
              <a class="dropdown-item" href="{{URL::to('admin/store')}}">Create Store</a>
            </div>
          </li>
          <li class="nav-item">
           <a class="nav-link" href="{{URL::to('admin/users')}}">Users</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Professional Services</a>
            <div class="dropdown-menu" aria-labelledby="dropdown04">
                <a class="dropdown-item" href="{{URL::to('about')}}">Add business</a>
                <a class="dropdown-item" href="{{URL::to('contact')}}">Manage business</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Orders</a>
            <div class="dropdown-menu" aria-labelledby="dropdown07">
              <a class="dropdown-item" href="{{URL::to('about')}}">Shop</a>
              <a class="dropdown-item" href="{{URL::to('contact')}}">Real estate and property</a>
              <a class="dropdown-item" href="{{URL::to('contact')}}">Professional services</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown08" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Setups</a>
            <div class="dropdown-menu" aria-labelledby="dropdown08">
              <a class="dropdown-item" href="{{URL::to('admin/category')}}">Category</a>
            </div>
          </li>
          <li class="nav-item">
           <a class="nav-link" href="{{URL::to('')}}">Market</a>
          </li>
        </ul>
        
      </div>
    </nav>

    @yield('content')    
    </div>
    </div>
      <a href="#" id="back2Top" class="text-white bg-danger" style="position: fixed; right: 2px; bottom: 2px;"><i class="fas fa-arrow-up"></i>Top</a>
  </main>
  <!-- page-content" -->
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->

 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script> 
    <script src="{{URL::asset('js/popper.min.js')}}"></script>
    <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('js/sidebar.js')}}"></script>
    <script src="{{URL::asset('js/aurjn/izitoast.min.js')}}"></script>
    <script src="{{URL::asset('js/aurjn/dev.c.lib.js')}}"></script>
    <script src="{{URL::asset('js/aurjn/devc.js')}}"></script>

 <script type="text/javascript">
 $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    /*Scroll to top when arrow up clicked BEGIN*/
  $(window).scroll(function() {
      var height = $(window).scrollTop();
      if (height > 100) {
          $('#back2Top').fadeIn();
      } else {
          $('#back2Top').fadeOut();
      }
  });
  $(document).ready(function() {
      $("#back2Top").click(function(event) {
          event.preventDefault();
          $("html, body").animate({ scrollTop: 0 }, "slow");
          return false;
      });
  
  });
   /*Scroll to top when arrow up clicked END*/
   </script>
    @yield('script')
</body>

</html>