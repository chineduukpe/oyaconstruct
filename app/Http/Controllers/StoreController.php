<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\category;
use App\subcategory;
Use App\store;
Use App\user;

class StoreController extends Controller
{
    //

     public function createstore(Request $request){
    	try {
    		DB::beginTransaction();
	        $request->validate([
	        	'name'=>'required',
	        	'email'=>'required|email',
	        	'phone'=>'required|min:11',
	        	'address'=>'required',
	        	'state'=>'required',
	        	'city'=>'required'
	        ]);
	      		$store=new store();
	      		$store->ownername=$request->name;
	      		$store->ownerphone=$request->phone;
	      		$store->owneraddress=$request->address;
	      		$store->owneremail=$request->email;
	      		$store->state=$request->state;
	      		$store->city=$request->city;
	      		$store->save();
	        	$name=$request->name;
	        	$email=$request->email;
	        	//send mail to user
		        $msg['text']="Dear $name, Thank you for using Oyaconstruct, your store is now registered on Oyaconstruct. You can now sign in an upload products under your store.";
		        $msg['link']="https://oyaconstruct.com/public/";
				parent::mail("Oyaconstruct",'contact@oyaconstruct.com',$name,$email,$msg,"Store Created",'mail');
				DB::commit();
				
	        return back()->with('success',"Store created successfully.");
	        
    	} catch (Exception $e) {
    		DB::rollback();
    		 return back()->with(['error'=>"Something went wrong, please try again."]);
     	}
    	
    }
    public function allstores(Request $request)
    {
    	$stores = store::paginate(2);
    	if ($request->ajax()) {
    		$view = view('admin/storedata',['stores' => $stores])->render();
            return response()->json(['html'=>$view]);
        }
    	return view('admin/store',['stores'=>$stores]);
    }

	public function getStoreById($id){
    	try {
    		$user=Store::where('id',$id)->first();
    		return $user;
    	} catch (Exception $e) {
    		
    	}
    }

    public function editstore(Request $request){
    	$id=$request->id;
    	return view('admin/editstore')->with('store',$this->getStoreById($id));
    }

    public function updatestore(Request $request){
    	//try {
    		// DB::beginTransaction();
			$id=$request->id;
			$updatetype=$request->updatetype;
			switch ($updatetype) {
			    	 	case '1':
			    	 		# code... 
			    	 		if(strlen($request->name)<3 || $request->email=="" || $request->city=="" || $request->idcardtype=="" || $request->state==""){
			    	 			return response()->JSON(['error'=>'1']);
							  
							  }else if(strlen($request->address)<5 ){
							   return response()->JSON(['error'=>'1']);
							  }else if(strlen($request->idcardno)<7 ){
							   return response()->JSON(['error'=>'1']);
							  }else{ 
				    	 		$data=array(
							        'ownername'=> $request->name,
							        'owneremail'=> $request->email,
							        'owneraddress'=> $request->address,
							        'ownerphone'=> $request->phone,
							        'state'=>$request->state,
							        'city'=> $request->city,
							        'idcardtype'=>$request->idcardtype,
							        'idcardno'=> $request->idcardno,
							        'status'=> $request->status,
							        'updated_at'=>date('Y-m-d G:i:s'),
						        );
						        if($request->status=="1"){
						        	$date['approvedby']=$request->session()->get('name');
						        	$date['dateapproved']=date('Y-m-d G:i:s'); 
						        }

					        DB::table('stores')->where('id',$id)->update($data);
					        return response()->JSON(['success'=>'1']);
					    }
			    	 		break;
			    	 	
			    	 	default:
			    	 		# code...
			    	 	return response()->JSON(['error'=>'1']);
			    	 		break;
			    	 }    	 
	   
    	// } catch (Exception $e) {
    	// 	return response()->JSON(['error'=>'1']);
     // 	}
    	
    }

    
}
