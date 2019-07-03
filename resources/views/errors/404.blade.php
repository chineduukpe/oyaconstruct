@extends('../layout')
@section('title')
 FAQ Oyaconstruct
@endsection

@section('style')
<style type="text/css">
  
  
</style>
 
@endsection

@section('content')
    <section id="inner-headline">
      <div class="container mt-5">
        <div class="row">
          <div class="col-lg-4">
            <div class="inner-heading">
              <h2>404</h2>
            </div>
          </div>
          <div class="col-lg-8">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="#">Pages</a> </li>
              <li class="breadcrumb-item active">404 Error page</li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <section id="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 alert alert-danger p-5">
            <h2 class="text-center">404 Error not found</h3>
				<p class="text-center">
					The provided URL does not exist on Oyaconstruct.com. Kindly use the menu or search to find products. Thank you.
				</p>
			</div>
		</div>
	</div>
	</section>
	
			@endsection
