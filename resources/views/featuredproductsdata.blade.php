<?php $i=0; ?>
@foreach($products as $product)
<?php
$pid=$product->id;
$pic=$product->productpic;
if($i==0){
?>
<div class="row">
<?php
}
++$i;
?>
<div class="col-md-3">
 	<div class="card mb-4 box-shadow thumbimgcard">
    <a href='{{URL::to("viewproduct/$pid")}}'>
 		<div class="card-body">
      <img class="card-img-top thumbimg" src='{{URL::to("product/storage/$pic")}}'>
      <div class="d-flex justify-content-between align-items-center">
        <span class="card-text">{{ $product->productname }}</span>
      </div>  
        <div class="d-flex justify-content-between align-items-center">
          <small class="badge badge-pill badge-danger">&#8358;{{ number_format($product->price,'2') }}</small>
           <div class="btn-group">
            <button type="button" class="btn btn-sm btn-danger">View</button>
          </div>
 		   </div>
 	</div>
  </a>
</div>
</div>
<?php 
if($i>=4){
?>
</div>
<?php
$i=0;
}
?>  
@endforeach
@if($products->nextPageUrl() != "")
  <div class="col-lg-12">
  <p class="text-right"><a href="{{URL::to('featuredproducts')}}"><small>view more</small></a></p>
  </div>
@endif          
