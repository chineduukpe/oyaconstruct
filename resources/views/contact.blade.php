@extends('layout')
@section('title')
 Contact Oyaconstruct
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
              <h2>Get in touch</h2>
            </div>
          </div>
          <div class="col-lg-8">
            <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{URL::to('index')}}"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="{{URL::to('about')}}">Pages</a></li>
              <li class="breadcrumb-item active">Contact</li>
            </ul>
          </nav>
          </div>
        </div>
      </div>
    </section>
    <section>
     
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
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h5 class="text-danger">Get in touch with us by filling <strong>contact form below</strong></h5>

            <form action="" method="post" role="form" class="contactForm">
              <div id="sendmessage">Your message has been sent. Thank you!</div>
              <div id="errormessage"></div>

              <div class="row">
                <div class="col-lg-4 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validation"></div>
                </div>
                <div class="col-lg-4 form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validation"></div>
                </div>
                <div class="col-lg-4 form-group">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                  <div class="validation"></div>
                </div>
                <div class="col-lg-12"></div>
                <div class="col-lg-12 form-group">
                  <textarea class="form-control" name="message" rows="12" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                  <div class="validation"></div>
                  <p class="text-center">
                    <button class="btn btn-danger" type="submit">Submit message</button>
                  </p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
@endsection
