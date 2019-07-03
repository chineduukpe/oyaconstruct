@foreach($users as $user)
<?php $id= $user->id?>
<div>
  <h5><a href='{{URL::to("admin/edituser?id=$id")}}'>{{ $user->name }}</a></h5>
  	<ul class="list-unstyled">
  		<li>{{ $user->email }}</li>
  		<li>{{ ucfirst($user->role) }}</li>
  		<li>{{ $user->phone }}</li>
	</ul>
  <div class="text-right">
  	<div class="dropdown show dropleft">
	  <a class="btn btn-danger dropdown-toggle" href="#" role="button" id="{{$user->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    View more
	  </a>

	  <div class="dropdown-menu" aria-labelledby="{{$user->id}}">
	  	<h6><a class="dropdown-header" href='{{URL::to("admin/edituser?id=$id")}}'>Edit</a></h6>
	    <div class="px-4 py-3">
	    	<ul class="list-unstyled">
	    		<li>
	    			Name: {{ strtoupper($user->name) }}
	    		</li>
	    		<li>
	    			Email: {{ $user->email }}
	    		</li>
	    		<li>
	    			User role: {{ ucfirst($user->role) }}
	    		</li>
	    		<li>
	    			  <hr style="margin-top:3px;">
	    		</li>
	    		<li>
	    			Phone number: {{ $user->phone }}
	    		</li>
	    		<li>
	    			Address: {{ $user->address }}
	    		</li>
	    		<li>
	    			Date of birth: {{ date('d-m-Y', strtotime($user->dob)) }}
	    		</li>
	    		<li>
	    			Gender: {{ ucfirst($user->gender) }}
	    		</li>
	    		<li>
	    			Marital Status: {{ ucfirst($user->msatus) }}
	    		</li>
	    	</ul>	
	    </div>
	  </div>
	</div>
    
  </div>


  <hr style="margin-top:5px;">
</div>
@endforeach