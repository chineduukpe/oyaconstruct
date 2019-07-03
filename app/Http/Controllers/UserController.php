<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\User;

class UserController extends Controller
{
    //


	public function insertuser(Request $request){
		$user=User::create(request(['name','email','password','role']));
		return true;
	}
    public function signup(Request $request){
    	try {
    		DB::beginTransaction();
	        $request->validate([
	        	'name'=>'required',
	        	'email'=>'required|email',
	        	'password'=>'required|min:8|confirmed',
	        	'role'=>'required'
	        ]);
	      
	        $insert=$this->insertuser($request);
	        if($insert){
	        	$name=$request->name;
	        	$email=$request->email;
	        	//send mail to user
		        $msg['text']="Dear $name, Thank you for using Oyaconstruct, you are now registered on Oyaconstruct. Your password: $request->password";
		        $msg['link']="https://oyaconstruct.com/verifyemail?email=".$email;
				parent::mail("Oyaconstruct",'contact@oyaconstruct.com',$name,$email,$msg,"Sign Up Successful",'signupmail');
				DB::commit();
				if($request->stype="admin"){
					return back()->with('success',"$name, You is registered successfully. An email has been sent to $email. Ask user to go his/her email to verify this account.");
				}
	        return view('signup')->with('success',"Dear $name, You have registered successfully. An email has been sent to you. Go to your email to verify your account.");
	        }
	        
    	} catch (Exception $e) {
    		DB::rollback();
    		 return back()->with(['error'=>"Something went wrong, please try again."]);
     	}
    	
    }


    public function verifyemail(Request $request){
    	try {
    		$email=$request->email;
	        $user=User::where('email',$email)->first();
	        if($user!=null){
	        	if($user->email_verified_at!=null){
	        		return redirect()->to('/login')->with('success'," Your email has been verified. You can now login");
	        	}
	        	$dateverified=date('Y-m-d G:i:s');
				DB::table('users')->where('email',$email)->update(['email_verified_at'=>$dateverified,'status'=>1]);
	        return redirect()->to('/login')->with('success',"Dear ". $user->name.", Your email has been verified. You can now login");
	        }
	        return redirect()->to('/signup')->with('error',"Please Signup here");
	        
    	} catch (Exception $e) {
    		DB::rollback();
    		 return redirect()->to('/signup')->with('error',"Please Signup here");
     	}
    	
    }

     public function login(Request $request){
    	try {
	        $password=$request->password;
	        $email=$request->email;
	        if(auth()->attempt(request(['email','password']))==false){
	        	return back()->with(['error'=>"The email or password is incorrect. Please try again."]);
	        }
	        
	        $user=User::where('email',$email)->first();

	        if($user->email_verified_at==null){
	        	//send mail to user
		        $msg['text']="Dear $name, Thank you for using Oyacontruct, you are registered on Oyaconstruct. Follow the link below to verify your email.";
		        $msg['link']="https://oyaconstruct.com/verifyemail?email=".$email;
				parent::mail("Oyaconstruct",'contact@oyaconstruct.com',$user->name,$email,$msg,"Verify email",'signupmail');
	        	return back()->with(['error'=>"Please verify your email. A mail has been sent to you."]);
	        }

	        if($user->status!=1){
	        	return back()->with(['error'=>"This account is inactive. Please contact Oyaconstruct to activate."]);
	        }
	        $request->session()->put('id',$user->id);
	        $request->session()->put('email',$user->email);
	        $request->session()->put('role',$user->role);
	        $request->session()->put('name',$user->name);
	        DB::table('users')->where('email',$email)->update(['last_login'=>date('d/m/Y')]);
	        if($user->role=="admin"){
	        	return redirect()->to('/admin/home');
	        }
	        if($user->role=="manager"){
	        	return redirect()->to('/manager/home');
	        }
			return redirect()->back()->with('success', "Welcome Back "+$user->name);
	        // if($user->role=="vendor"){
	        // 	return redirect()->to('/vendor/home');
	        // }
	        // return redirect()->to('/user/home');
    	} catch (Exception $e) {
    		DB::rollback();
    		 return back()->with(['error'=>"The email or password is incorrect. Please try again."]);
     	}
    	
    }

    public function logout(Request $request){
    	$request->session()->forget('id');
    	$request->session()->forget('email');
    	$request->session()->forget('role');
    	$request->session()->forget('name');
    	auth()->logout();
    	return redirect()->to('/index');
    }

    public function loggedout(Request $request){
    	
    	return view('/login');
    }

    public function resetcode(Request $request){
    	$email=$request->email;
    	$user=user::where('email',$email)->first();
    	if($user==NULL){
    		return back()->with('error','No User exist with this email on Oyaconstruct');
    	}
    	$codecharacters=trim($user->name.strtotime(date('Y-m-d G:i:s')));
    	$code=parent::codegenerator(8,$codecharacters);
    	$today=date('Y-m-d G:i:s');
    	try {
    		DB::beginTransaction();
    		$password_resets=DB::table('password_resets')->where('email',$email)->first();
    		if($password_resets!=NULL){
    			DB::table('password_resets')->where('email',$email)->update(['token'=>$code]);
    		}else{
    			DB::insert('insert into password_resets (email, token,created_at) values (?, ?, ?)', [$email, $code,$today]);
    		}
    		$msg['text']="Dear $user->name, Your password reset code is: $code. Follow the link provided below to reset your password.";
    		$msg['link']="https://oyaconstruct.com/resetpassword?email=$email";	
    		parent::mail("Oyaconstruct",'contact@oyaconstruct.com',$user->name,$email,$msg,"Reset Password",'mail');
    		DB::commit();
    		return redirect()->to('resetpassword')->with('success','A password reset code has been sent to your email. Kindly go to your email to continue.');
    	} catch (Exception $e) {
    		DB::rollback();
    		return redirect()->to('resetpassword')->with('error','Something went wrong while trying to send password reset code. <a href="#myReset" data-dismiss="modal" aria-hidden="true" data-toggle="modal">Reset</a>');
    	}
    }

    public function passwordreset(Request $request){
    	
	    if($request->has('code')){
	    	try{
	    		$password_resets=DB::table('password_resets')->where('token',$request->code)->first();
	    		if($password_resets==null){
	    			return back()->with('error','No password reset code was sent to this email. Click login to reset');
	    		}
	    		if($request->code!=$password_resets->token){
	    			return back()->with('error','Wrong password reset code provided. Click login to reset password again.</a>');
	    		}
	    		if($request->password!=$request->password_confirmation){
	    			return back()->with('error','Passwords do not match');
	    		}
	    		$email=$password_resets->email;
	    		DB::beginTransaction();
	    		DB::table('users')->where('email',$email)->update(['password'=>bcrypt($request->password)]);
	    		DB::table('password_resets')->where('email',$email)->update(['token'=>strtotime(date('Y-m-d G:i:s'))]);
	    		DB::commit();
	    		return redirect()->to('login')->with('success','Your password is changed. You can login now');
	    	} catch (Exception $e) {
    			DB::rollback();
    			return back()->with('error','Something went wrong while trying to send password reset code. Click login to reset again.');
    		}
    	}	
    	return view('resetpassword');
    }
 public function allusers(Request $request)
    {
    	$users = User::orderBy('name','asc')->paginate(2);
    	if ($request->ajax()) {
    		$view = view('admin/data',['users' => $users])->render();
            return response()->json(['html'=>$view]);
        }
    	return view('admin/users',['users'=>$users]);
    }
    public function searchuser(Request $request){
    	try {
    		$name=$request->name;
    		$users=DB::table('users')->whereRaw("email like '%$name%' || name like '%$name%' || phone like '%$name%'")->orderBy('name','asc')->get();
    		echo json_encode($users);
    		//SELECT distinct * FROM users WHERE email LIKE '%e%' || phone LIKE '%e%' || name LIKE '%e%'
    	} catch (Exception $e) {
    		
    	}

    }

    public function getUserById($id){
    	try {
    		$user=User::where('id',$id)->first();
    		return $user;
    	} catch (Exception $e) {
    		
    	}
    }

    public function edituser(Request $request){
    	$id=$request->id;
    	return view('admin/edituser')->with('user',$this->getUserById($id));
    }

    public function updateuser(Request $request){
    	try {
    		// DB::beginTransaction();
			$id=$request->id;
			$updatetype=$request->updatetype;
			switch ($updatetype) {
			    	 	case '1':
			    	 		# code... 
			    	 		if(strlen($request->name)<3 || $request->dob=="" || $request->role==""){
			    	 			return response()->JSON(['error'=>'1']);
							  
							  }else if(strlen($request->password)>0 && strlen($request->password)<8){
							   return response()->JSON(['error'=>'1']);
							  }else{ 
				    	 		$data=array(
							        'name'=> $request->name,
							        'dob'=> $request->dob,
							        'gender'=>$request->gender,
							        'mstatus'=> $request->mstatus,
							        'role'=>$request->role,
							        'updated_at'=>date('Y-m-d G:i:s'),
						        );
						        if($request->password!=""){
						        	$date['password']=bcrypt($request->password); 
						        }

					        DB::table('users')->where('id',$id)->update($data);
					        return response()->JSON(['success'=>'1']);
					    }
			    	 		break;
			    	 	case '2':
			    	 		# code...
			    	 		if(strlen($request->address)<5 ){
			    	 			return response()->JSON(['error'=>'1']);
							  
							  }else if(strlen($request->phone)<11 || strlen($request->phone)>14){
							   return response()->JSON(['error'=>'1']);
							  }else{ 
				    	 		$data=array(
							        'address'=> $request->address,
							        'phone'=> $request->phone,
							        'state'=>$request->state,
							        'lga'=> $request->city,
							        'updated_at'=>date('Y-m-d G:i:s'),
						        );
					        DB::table('users')->where('id',$id)->update($data);
					         return response()->JSON(['success'=>'1']);
					     }
			    	 		break;
			    	 		
			    	 	default:
			    	 		# code...
			    	 	return response()->JSON(['error'=>'1']);
			    	 		break;
			    	 }    	 
	   
    	} catch (Exception $e) {
    		return response()->JSON(['error'=>'1']);
     	}
    	
    }


public function checkemail(Request $request){
	try {
		$email=$request->email;
		$user=user::where('email',$email)->count();
		if($user>0) echo "1";
		else echo "0";
	} catch (Exception $e) {
		echo "0";
	}
}

public function myprofile(Request $request){
	$id=$request->session()->get('id');
	echo json_encode($this->getUserById($id));
}

public function editprofile(Request $request){
	$id=$request->session()->get('id');
	return view('user/editprofile')->with('users',json_encode($this->getUserById($id)));
}

public function changepassword(Request $request){
	try {
		$request->validate([
	        	'email'=>'required|email',
	        	'newpassword'=>'required|min:8|confirmed'
	        ]);
	      
	$data=array(
		'password'=>bcrypt($request->newpassword),
		'updated_at'=>date('Y-m-d G:i:s')
	);
	DB::table('users')->where('email',$request->email)->update($data);
	return back()->with('success','Password changed for user with email '.$request->email);
	} catch (Exception $e) {
		
	}
	
}

public function getuser(Request $request){
	$email=$request->email;
	$user=user::where('email',$email)->get();
	echo json_encode($user);
}

}
