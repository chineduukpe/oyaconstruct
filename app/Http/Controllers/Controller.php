<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function mail($senderName,$sender,$receiverName,$receiver,$msg,$subject,$view)
    {
        
      
       Mail::to($receiver)->send(new SendMailable($senderName,$sender,$receiverName,$receiver,$msg,$subject,$view));
       
       //return 'Email was sent';
    }

    public function codegenerator($length,$Caracteres){ 
        //Under the string $Caracteres you write all the characters you want to be used to randomly generate the code. 
        //$Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789'; 
        $characterlength = strlen($Caracteres); 
        $characterlength--; 
        
        $Hash=NULL; 
            for($x=1;$x<=$length;$x++){ 
                $position = rand(0,$characterlength); 
                $Hash .= substr($Caracteres,$position,1); 
            } 
        
        return strtolower($Hash); 
    } 

}
