<?php $i=0; ?>
@foreach($products as $product)
<?php
$pic=$product->productpic;
$pid=$product->id;
$soldpercent=0;
if($product->quantity!=0){
  $soldpercent=($product->nosold/$product->quantity)*100;
}

if($i==0){
?>
<div class="row">
<?php
}
++$i;
?>
<div class="col-md-2">
 	<div class="card mb-4 box-shadow border-0 thumbimgcard">
    <a href='{{URL::to("viewproduct/$pid")}}'>
 		<div class="card-body">
      <img class="card-img-top thumbimg" src='{{URL::to("product/storage/$pic")}}'>
      <div class="d-flex justify-content-between align-items-center mt-1 mb-2">
          <small class="text-secondary">&#8358;{{ number_format($product->price) }}</small>
          <?php if($product->discount>0){?>
          <small class="badge badge-pill badge-danger">{{ $product->discount }}%</small>
        <?php } ?>
      </div>
      <div class="d-flex align-items-center mt-1 mb-2">
          <small class="text-secondary">{{ ucwords(strtolower($product->productname)) }}</small>
      </div>
 	</div>
  </a>
</div>
</div>
<?php 
if($i>4){
?>
</div>
<?php
$i=0;
}
?>  
@endforeach
@if($products->nextPageUrl() != "")
  <div class="col-lg-12">
  <p class="text-right"><a href="{{URL::to('shop')}}"><small>view more</small></a></p>
  </div>
@endif          
