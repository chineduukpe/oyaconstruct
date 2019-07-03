@extends('layout')
@section('title')
 Terms Oyaconstruct
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
              <h2>Terms & Privacy</h2>
            </div>
          </div>
          <div class="col-lg-8">
            <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('index')}}"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item active">Terms and policies</li>
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
        <div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-danger pb-2 mb-0">Privacy Policy</h6>
        <div class="media text-muted pt-3">
          <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-danger">
            <strong class="d-block text-gray-dark">@privacy</strong>
            By visiting Oyaconstruct.com you are acknowledging and consenting to our privacy policy. Our customers come first, therefore we are constantly improving our systems and devising means of protecting all information about our customers as they are the most important part of our business, we shall and will not share, sell or disclose entrusted information to others except with your written consent. At the point of signing up, all information required is what we receive and use to process/authenticate your order as well as payment, you will receive notice when information about you might go to third parties and you will have an opportunity to choose not to share the information.</p>
          </div>
          <div class="media text-muted pt-3">
            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-danger">
            <strong class="d-block text-gray-dark">@Communication</strong>
            When you visit Oyaconstruct.com or send e-mails to us, you are communicating with us electronically. We communicate with you by e-mail or by posting notices on the website. By using our Website you consent to receive communications from us electronically and you agree that all agreements, notices, disclosures and other communications that we provide to you electronically satisfy any legal requirement that such communications be in writing. This condition does not affect your statutory rights.</p>
          </div>
          <div class="media text-muted pt-3">
        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-danger">
            <strong class="d-block text-gray-dark">Report to help@oyaconstruct.com</strong>
            If you notice unusual activity on your account or have any concern, kindly write to us through help@oyaconstruct.com
          </p>
          
        </div>
        <!-- <small class="d-block text-right mt-3">
          <a href="#">All updates</a>
        </small> -->
      </div>

      <div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-danger pb-2 mb-0">Return Policy</h6>
        <div class="media text-muted pt-3">
          <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-danger">
            We shall allow for returns of incorrect item (s) or defective product (s) as long as it has not been tampered with or used by customer (s) and this return period is within five (5) working days after delivery. However, it is important to note that items sold on Oyaconstruct.com are and will be sold by different vendors (sellers) because our platform is a marketplace and as such, individual vendor (seller) reserves the right to choose whether or not his/her product (s) can or should be returned. If a vendor (seller) allows for a product to be returned, customer can then write to Oyaconstruct.com through help@oyaconstruct.com for proper investigation and approval/return authorization.</p>
          </div>
          
      </div>

      <div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-danger pb-2 mb-0">Terms and conditions</h6>
        <div class="media text-muted pt-3">
          <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-danger">
            Welcome to Oyaconstruct.com, we provide access to the Oyaconstruct.com website (the “Website”) and allow you to buy and sell products subject to the terms and conditions set out on this page.
            Please read these conditions carefully before using the website. Using the website indicates your intention to be bound by these terms and conditions.
            In addition, when you use any current or future Oyaconstruct.com service, you will also be subject to the terms, guidelines and conditions applicable to that service (“Terms”). Where these Terms and Conditions of Use & Sales are conflicting with such Terms, the Terms will prevail.</p>
            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-danger">
              
            </p>
          </div>
          
      </div>
      </div>
    </section>    
@endsection
