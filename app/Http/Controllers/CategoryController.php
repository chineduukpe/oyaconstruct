<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\category;
use App\subcategory;

class CategoryController extends Controller
{
    //
    public function addcategory(Request $request){
    	try {
    		DB::beginTransaction();
	        $request->validate([
	        	'catname'=>'required|min:3',
	        	'service'=>'required',
	        ]);
	        $category=new category();
	      	$category->catname=$request->catname;
	      	$category->servicetype=$request->service;
	        $category->save();
			DB::commit();
			return back()->with('success',"Category added successfully");
    	} catch (Exception $e) {
    		DB::rollback();
    		 return back()->with(['error'=>"Something went wrong, please try again."]);
     	}
    	
    }

    public function allcategories(Request $request){
    	$cats=category::where('servicetype',$request->service)->orderBy('catname','asc')->get();
    	echo json_encode($cats);
    }

        public function addsubcat(Request $request){
    	try {
    		DB::beginTransaction();
	        $catid=$request->catid;
	        $subcat=$request->subcat;
	        $category=category::where('id',$catid)->first();
	        $subcategory=new subcategory();
	      	$subcategory->servicetype=$category->servicetype;
	      	$subcategory->catname=$catid;
	      	$subcategory->subcat=$subcat;
	        $subcategory->save();
			DB::commit();
			return response()->JSON(['success'=>1]);
    	} catch (Exception $e) {
    		DB::rollback();
    		 return response()->JSON(['error'=>"Something went wrong, please try again."]);
     	}
    	
    }

    public function subcat_catid(Request $request){
    	$cats=subcategory::where('catname',$request->catid)->orderBy('subcat','asc')->get();
    	echo json_encode($cats);
    }

    public function editcat(Request $request){
        try {
            DB::beginTransaction();
            $catid=$request->catid;
            $cat=$request->cat;
            DB::table('categories')->where('id',$catid)->update(['catname'=>$cat]);
            DB::commit();
            return response()->JSON(['success'=>1]);
        } catch (Exception $e) {
            DB::rollback();
             return response()->JSON(['error'=>"Something went wrong, please try again."]);
        }
        
    }
}
