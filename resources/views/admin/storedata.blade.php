<?php $i=0; 
if(count($stores)>0){
?>
@foreach($stores as $store)
<?php $id=$store->id ?>
<div class="card-body text-muted">
  <h5 class="pb-3 mb-0 border-bottom border-danger">{{++$i}}. <a href='{{URL::to("admin/product/$store->id")}}'>{{ $store->ownername }}</a></h5>
  <ul class="list-unstyled">
  <li><span>{{ $store->owneremail }}</span>; <span>{{ $store->ownerphone }}</span></li>
  <li><span>{{ $store->owneraddress }}</span></li>
  <li><span>{{ $store->city }}</span>, <span>{{ $store->state }}</span></li>
</ul>
 <div class="justify-content-center align-items-center">
 <div></div>
 <div class="dropdown show dropleft">
 	  <a href='{{URL::to("admin/product/$store->id")}}'><button class="btn btn-danger" >View products</button></a>
	  <a class="btn btn-danger dropdown-toggle" href="#" role="button" id="{{$store->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    View more
	  </a>

	  <div class="dropdown-menu" aria-labelledby="{{$store->id}}">
	  	<h6><a class="dropdown-header" href='{{URL::to("admin/editstore?id=$id")}}'>{{ $store->ownername }}-Edit</a></h6>
	    <div class="px-4 py-3">
	    	<ul class="list-unstyled">
	    		<li>
	    			<hr style="margin-top:3px;">
	    		</li>
	    		<li>
	    			Id Card Number: {{ $store->idcardno }}
	    		</li>
	    		<li>
	    			Id Card Type: {{ $store->idcardtype }}
	    		</li>
	    		<li>
	    			Date Approved {{ date('d-m-Y', strtotime($store->dateapproved)) }}
	    		</li>
	    		
	    		<li>
	    			Approved by: {{ $store->approvedby }}
	    		</li>
	    		
	    	</ul>	
	    </div>
	  </div>
	</div>
    
 </div>
</div>
@endforeach
<?php }?>