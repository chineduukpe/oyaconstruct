<?php $i=0; 

?>

@foreach($products as $product)
<?php
$pic=$product->productpic;
$pid=$product->id;
$soldpercent=($product->nosold/$product->quantity)*100;
if($i==0){
?>
<div class="row">
<?php
}
++$i;
?>
<div class="col-md-3">
 	<div class="card mb-4 box-shadow border-0 thumbimgcard">
    <a href='{{URL::to("viewproduct/$pid")}}'>
 		<div class="card-body">
      <img class="card-img-top thumbimg" src='{{URL::to("product/storage/$pic")}}'>
      <div class="d-flex justify-content-between align-items-center mt-1 mb-2">
          <small class="text-secondary">&#8358;{{ number_format($product->price) }}</small>
          <small class="badge badge-pill badge-danger">{{ $product->discount }}% OFF</small>
      </div>
          <div id="" class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%">10</div>
          </div>
       <small class="text-muted">{{$product->nosold }} SOLD</small>
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
  <p class="text-right"><a href="{{URL::to('flashproducts')}}"><small>view more</small></a></p>
  </div>
@endif          
