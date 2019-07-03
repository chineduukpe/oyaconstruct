<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>@yield('title','Oyaconstruct - Home of everything construction related')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Shop for construction materials online. Buy and order material. Create your store and have oyaconstruct buy from you." />
  <meta name="author" content="Oyaconstruct" />

  <!-- css -->
  <link href="https://fonts.googleapis.com/css?family=Noto+Serif:400,400italic,700|Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="{{URL::asset('css/bootstrap.css')}}" rel="stylesheet" />
  <link href="{{URL::asset('css/bootstrap-responsive.css')}}" rel="stylesheet" />
  <link href="{{URL::asset('css/fancybox/jquery.fancybox.css')}}" rel="stylesheet">
  <link href="{{URL::asset('css/jcarousel.css')}}" rel="stylesheet" />
  <link href="{{URL::asset('css/flexslider.css')}}" rel="stylesheet" />
  <link href="{{URL::asset('css/style.css')}}" rel="stylesheet" />
  <link href="{{URL::asset('css/mystyle.css')}}" rel="stylesheet" />
  <!-- Theme skin -->
  <link href="{{URL::asset('skins/default.css')}}" rel="stylesheet" />
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
@yield('style')
<style type="text/css">
#inner-headline .inner-heading h2 {
    color: #fff;
    font-size: 20px;
}
#inner-headline .row{
  margin-top:2px;
  margin-bottom: 2px;
}

</style>
</head>
<body>
<div class="container">
  <div class="mt-2">
 
<h1>{{ $subject }}</h1>

<div> <p>{{ $msg['text'] }}.</p>
<p><a href="{{ $msg['link'] }}">Click here to reset your password</a></p>
<p>Best Regards</p>
</div>
</div>
</div>
  <div class="footer-copyright text-center py-3">© 2019:
      <a href="#">Oyaconstruct.com</a>
    </div>
<!-- javascript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="{{URL::asset('js/jquery.js')}}"></script>
  <script src="{{URL::asset('js/jquery.easing.1.3.js')}}"></script>
  <script src="{{URL::asset('js/bootstrap.js')}}"></script>
  <script src="{{URL::asset('js/jcarousel/jquery.jcarousel.min.js')}}"></script>
  <script src="{{URL::asset('js/jquery.fancybox.pack.js')}}"></script>
  <script src="{{URL::asset('js/jquery.fancybox-media.js')}}"></script>
  <script src="{{URL::asset('js/google-code-prettify/prettify.js')}}"></script>
  <script src="{{URL::asset('js/portfolio/jquery.quicksand.js')}}"></script>
  <script src="{{URL::asset('js/portfolio/setting.js')}}"></script>
  <script src="{{URL::asset('js/jquery.flexslider.js')}}"></script>
  <script src="{{URL::asset('js/jquery.nivo.slider.js')}}"></script>
  <script src="{{URL::asset('js/modernizr.custom.js')}}"></script>
  <script src="{{URL::asset('js/jquery.ba-cond.min.js')}}"></script>
  <script src="{{URL::asset('js/jquery.slitslider.js')}}"></script>
  <script src="{{URL::asset('js/animate.js')}}"></script>

  <!-- Template Custom JavaScript File -->
  <script src="{{URL::asset('js/custom.js')}}"></script>
  @yield('script')
</body>
</html> 
 