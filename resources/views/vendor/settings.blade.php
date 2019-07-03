@extends('vendor.vendorlayout')

@section('vendorcontent')
<div id="page-content-wrapper">
	<div class="container-fluid">
		<div class="row p-5">
			<div class="col-md-6">
				<h4><strong>Store Details </strong></h4>
				
				<form class="form-horizontal" method='post' action="{{route('vendor.update',$store->id)}}">
                
					{{ csrf_field() }}
					<input type="hidden" name="_method" value="PUT">
					<div class="form-group">
						<label class="control-label" for="name">Store Name*</label>
						<input type="text" id="name" name="ownername" placeholder="Full name" required="required" autocomplete="off" class="form-control" value="{{$store->ownername}}">
					</div>
					<div class="form-group">
						 <label class="control-label" for="email">Store Email*</label> 
						<input type="email" id="email" name="businessemail" placeholder="mystore@domain.com"  autocomplete="off" class="form-control" value="{{$store->businessemail}}">
					</div>
					<div class="form-group">
						<label class="control-label" for="name">Store Address*</label>
						<textarea id="address" name="owneraddress" placeholder="Current location" required="required" autocomplete="off" class="form-control" > {{$store->owneraddress}} </textarea>
					</div>
					<div class="form-group">
						<label class="control-label" for="email">Store Phone*</label>
						<input type="text" id="phone" name="ownerphone" placeholder="phone number"  required="required" autocomplete="off" class="form-control" value="{{$store->ownerphone}}">
					</div>
					
					<div class="form-group">
						<label class="control-label" for="">State*</label>
						<select name="state" id="state" class="form-control" required="required">
							<?php 
							$filecontents = Storage::disk('local')->get('nigerianstatesandlgas.json');
							$array = json_decode($filecontents, true);
							$i = 0;
							for($i=0; $i<count($array); $i++){
							$sel=($store->state==$array[$i]["state"]["name"])?"selected":"";
							$state = "";
							$state = $state.'<option value="'.$array[$i]["state"]["name"].'"';
							$state = $state.' '.$sel.'>';
							$state = $state.$array[$i]["state"]["name"];
						$state = $state.'</option>';
						echo $state;
					}
					
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="">City*</label>
				<input type="text" id="city" name="city" value="{{$store->city}}" class="form-control">
			</div>
			<div class="form-group">
				<label class="control-label" for="">Id Card Type*</label>
				<select name="idcardtype" id="idcardtype" class="form-control">
					<option value="">select</option>
					<option value="national id" <?php echo (strtolower($store->idcardtype)=="national id")?"selected":"" ?> >National ID</option>
					<option value="driver liscence" <?php echo (strtolower($store->idcardtype)=="driver liscence")?"selected":"" ?> >Driver's Liscence</option>
					<option value="voter card" <?php echo (strtolower($store->idcardtype)=="voter card")?"selected":"" ?> >Voter's card</option>
					<option value="international Passport" <?php echo (strtolower($store->idcardtype)=="international Passport")?"selected":"" ?> >International Passport</option>
				</select>
			</div>
			<div class="form-group">
				<label for="password2">ID card number*</label>
				<input type="text" id="idcardno" name="idcardno" value="{{$store->idcardno}}" class="form-control">
			</div>
			
			<div class="form-group">
				<label class="control-label" for="password2">Approved*</label>
				<select name="status" id="status" disabled required="required" class="form-control">
					<option value="1"  <?php echo ($store->status==1)?"selected":"" ?> >Approved/Active</option>
					<option value="0"  <?php echo ($store->status==0)?"selected":"" ?>>New</option>
					<option value="2"  <?php echo ($store->status==2)?"selected":"" ?>>Inactive</option>
				</select>
			</div>
			<div class="ajax-load text-center" style="display:none">
				<p><img src="{{URL::asset('img/lightbox/preloader.gif')}}"></p>
			</div>
			<p id="message"></p>
			<div class="form-group">
				<button type="submit" class="btn btn-danger" id="btn1">Update</button>
			</div>
		</form>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-head text-center mt-3"><h5>New Products</h5></div>
			<div class="card-body">
				<div id="post-data">
					<div class="card-body text-muted">
						<h5 class="pb-3 mb-0 border-bottom border-danger">1. <a href='#'>Product Title </a></h5>
						<ul class="list-unstyled">
							<li><span></span> <span>Available Quantity</span></li>
							<li><span>Product Desctipyion</span></li>
							<li><span>Abuja</span>, <span>FCT</span></li>
						</ul>
						<div class="justify-content-center align-items-center">
							<div></div>
							<div class="dropdown show dropleft">
								<a href='#'><button class="btn btn-danger" >View product</button></a>
								<a class="btn btn-danger dropdown-toggle" href="#" role="button" id="1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									View more
								</a>

								<div class="dropdown-menu" aria-labelledby="1">
									<h6><a class="dropdown-header" href='#'>OyaConstruct.com-Edit</a></h6>
									<div class="px-4 py-3">
										<ul class="list-unstyled">
											<li>
												<hr style="margin-top:3px;">
											</li>
											<li>
												Id Card Number: 6789076543
											</li>
											<li>
												Id Card Type: national id
											</li>
											<li>
												Date Approved 01-01-1970
											</li>
											
											<li>
												Approved by: 23
											</li>
											
										</ul>	
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
</div>
</div>
@endsection