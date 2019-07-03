@extends('layout')
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
              <h2>Get answers</h2>
            </div>
          </div>
          <div class="col-lg-8">
            <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{URL::to('index')}}"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="{{URL::to('about')}}">Pages</a></li>
              <li class="breadcrumb-item active">FAQ</li>
            </ul>
          </nav>
          </div>
        </div>
      </div>
    </section>
    <section id="content">
      <div class="container">
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
        <div class="row">
          <div class="col-lg-6">
            <h3>Welcome to <strong>Oyaconstruct</strong></h3>
            <p>
             Oyaconstruct provides construction materials from different vendors for easy shopping and delivery to you. Our customers ask some questions which will help you understand more about using the platfom. If still in doubt, you can <a href="{{URL::to('contact')}}">get in touch with us</a>
             And  chat with is through our live chat facility. 
            </p>
            
          </div>
          <div class="col-lg-6">
            <h4>More about us</h4>
            <div class="accordion" id="accordion2">
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle btn btn-danger" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
              1. What we do </a>
                </div>
                <div id="collapseOne" class="accordion-body collapse in">
                  <div class="accordion-inner">
                    <p>
                      We sell and delivery construction materials from our esteem vendors to you. You can shop online and have your quotation delivered to you.
                    </p>
                  </div>
                </div>
              </div>
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle btn btn-danger" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
              2. Work process </a>
                </div>
                <div id="collapseTwo" class="accordion-body collapse">
                  <div class="accordion-inner">
                    <p>
                      Oyaconstruct provide products from the manufacturer to your delight. Our store owners stock their products and we offer them for sale on our platform. Be assured that we are offer the best stock at very affordable prices.
                    </p>
                  </div>
                </div>
              </div>
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle btn btn-danger" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
              3. Quality assurance </a>
                </div>
                <div id="collapseThree" class="accordion-body collapse">
                  <div class="accordion-inner">
                    <p>
                      We offer you 1 year guaranty on any product purchased at Oyaconstruct.
                    </p>
                  </div>
                </div>
              </div>
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle btn btn-danger" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
              4. What we can deliver </a>
                </div>
                <div id="collapseFour" class="accordion-body collapse">
                  <div class="accordion-inner">
                    <p>
                      We have construction material for sale. Simply search our products using the product category search
                    </p>
                    <p>
                      We offer houses for sale, rent and lease
                    </p>
                    <p>
                      We provide access to proffessional services
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
        </div>
      </div>
    </section>
@endsection
