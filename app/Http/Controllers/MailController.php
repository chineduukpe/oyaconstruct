<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;



class MailController extends Controller
{
	public function mail($senderName,$sender,$receiverName,$receiver,$msg,$subject)
	{
		
	  
	   Mail::to($receiver)->send(new SendMailable($senderName,$sender,$receiverName,$receiver,$msg,$subject));
	   
	   //return 'Email was sent';
	}
     public function contact(Request $request) {
     	$name=$request->name;
     	$email=$request->email;
     	$subject=$request->subject;
     	$msg=$request->msg;
      	 $this->mail($name,$email,"Oyaconstruct","contact@oyaconstruct.com",$msg,$subject);
       echo "Your message is sent. We will contact you in 1hr-24hrs. Thank you.";
   }
   
}
