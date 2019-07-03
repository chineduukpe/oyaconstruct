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
Use App\product;

class ProductController extends Controller
{
    //
    public function addproduct(Request $request){
        try {
            DB::beginTransaction();
            $request->validate([
                'name'=>'required',
                'cost'=>'required',
                'quantity'=>'required',
                'shortdesc'=>'required',
                'pic'=>'required',
                'storeid'=>'required',
            ]);
            $picname="";
            if($request->hasfile('pic'))
         {
            $exts=explode(',',"jpeg,png,jpg");
            $pic=$request->file('pic');
            $filename=$pic->getClientOriginalName();
            $ext=substr($filename, strpos($filename, '.'));
            if(!in_array(substr($ext, 1), $exts)){
                 return back()->with('error',"Wrong image type uploaded. Image must be of type jpeg, jpg or png");
            }
            $max=product::max('id');
            $picname=++$max.".jpg";
            $pic->move(storage_path().'/app/public/productpic/', $picname);
            //insert into document
            $product=new product();
            $product->productname=addslashes($request->name);
            $product->shortdesc=addslashes(preg_replace("/[\n\r]/", " ", $request->shortdesc));
            $product->category=$request->category;
            $product->subcategory=$request->subcategory;
            $product->quantity=$request->quantity;
            $product->productpic=$picname;
            $product->price=$request->cost;
            $product->storeid=$request->storeid;
            $product->save();
            DB::commit();
            return back()->with('success',"Product added successfully");  
         }             
             
        } catch (Exception $e) {
            DB::rollback();
             return back()->with(['error'=>"Something went wrong, please try again."]);
        }
        
    }
     public function storeproducts($storeid, Request  $request){
        $store=store::where('id',$storeid)->first();
     	$products = product::where('storeid',$storeid)->paginate(2);
    	if ($request->ajax()) {
    		$view = view('admin/productdata',['products' => $products,'storeid'=>$storeid,'storestatus'=>$store->status])->render();
            return response()->json(['html'=>$view]);
        }
    	return view('admin/product',['products'=>$products,'store'=>$store,'storestatus'=>$store->status]);
     }

     public function singleproduct($id, Request  $request){
        //$store=store::where('id',$storeid)->first();
        $products = product::where('id',$id)->first();
        return view('viewproduct');
     }

     public function editproductaltpic(Request $request){
        try{
            $productid=$request->productid;
            $picnumber=$request->picno;
            $picname="";
            if($request->hasfile('pic'))
             {
                $exts=explode(',',"jpeg,png,jpg");
                $pic=$request->file('pic');
                $filename=$pic->getClientOriginalName();
                $ext=substr($filename, strpos($filename, '.'));
                if(!in_array(substr($ext, 1), $exts)){
                     return back()->with('error',"Wrong image type uploaded. Image must be of type jpeg, jpg or png");
                }
                $picname=$productid.$picnumber.".jpg";
                $pic->move(storage_path().'/app/public/productpic/', $picname);
             }else{
                return back()->with('error',"No image uploaded");
             } 

             //update
             if($picnumber==1){
                DB::table('products')->where('id',$productid)->update(['pic1'=>$picname]);
                return back()->with('success',"Alt picture 1 updated successfully");
             }else if($picnumber==2){
                DB::table('products')->where('id',$productid)->update(['pic2'=>$picname]);
                return back()->with('success',"Alt picture 2 updated successfully");
             }else if($picnumber==3){
                DB::table('products')->where('id',$productid)->update(['pic3'=>$picname]);
                return back()->with('success',"Alt picture 3 updated successfully");
             }else if($picnumber==4){
                DB::table('products')->where('id',$productid)->update(['pic4'=>$picname]);
                return back()->with('success',"Alt picture 4 updated successfully");
             }
        }catch(Exception $e){
            return back()->with('error',"A network error occured. Please try again.");
        }       
     }

     public function editproductpic(Request $request){
        try{
            $productid=$request->productid2;
            $picname="";
            if($request->hasfile('pic'))
             {
                $exts=explode(',',"jpeg,png,jpg");
                $pic=$request->file('pic');
                $filename=$pic->getClientOriginalName();
                $ext=substr($filename, strpos($filename, '.'));
                if(!in_array(substr($ext, 1), $exts)){
                     return back()->with('error',"Wrong image type uploaded. Image must be of type jpeg, jpg or png");
                }
                $picname=$productid.".jpg";
                $pic->move(storage_path().'/app/public/productpic/', $picname);
                //update
            
                DB::table('products')->where('id',$productid)->update(['productpic'=>$picname]);
                return back()->with('success',"Picture updated successfully");
             }else{
                return back()->with('error',"No image uploaded");
             } 
        }catch(Exception $e){
            return back()->with('error',"A network error occured. Please try again.");
        }       
     }

     public function managestock(Request $request){
        try {
            $productid=$request->productid3;
            $price=$request->price1;
            $qty=$request->qty1;
            $data=array(
                'price'=>$price,
                'quantity'=>$qty,
            );

            DB::table('products')->where('id',$productid)->update($data);
            return back()->with('success',"Picture stock details updated successfully");
        } catch (Exception $e) {
           return back()->with('error',"Something went wrong. It could be network."); 
        }
     }

     public function manageprodpriv(Request $request){
        try {
            $productid=$request->productid4;
            $dis=$request->discount;
            $feature=$request->featured;
            $data=array(
                'discount'=>$dis,
                'featured'=>$feature,
            );

            DB::table('products')->where('id',$productid)->update($data);
            return back()->with('success',"Picture privileges updated successfully");
        } catch (Exception $e) {
           return back()->with('error',"Unable to perform update."); 
        }
     }

     public function editproddet(Request $request){
        try {
            $productid=$request->productid5;
            $shortdesc=$request->shortdesc5;
            $name=$request->prodname5;
            $category=$request->category5;
            $subcategory=$request->subcategory5;
            $data=array(
                'productname'=>$name,
                'shortdesc'=>$shortdesc,
                'category'=>$category,
                'subcategory'=>$subcategory,
            );

            DB::table('products')->where('id',$productid)->update($data);
            return back()->with('success',"Picture details updated successfully");
        } catch (Exception $e) {
           return back()->with('error',"Unable to update product details"); 
        }
     }

     public function getfeatured(Request $request){

        $products=DB::table('products')->join('stores', 'products.storeid', '=', 'stores.id')->where("products.featured",'yes')->orderBy('products.created_at','desc')->paginate(8);
        if ($request->ajax()) {
            $view = view('featuredproductsdata',['products' => $products])->render();
            return response()->json(['html'=>$view]);
        }
     }

     public function featuredproducts(Request $request){

        $products=DB::table('products')->join('stores', 'products.storeid', '=', 'stores.id')->where("products.featured",'yes')->orderBy('products.created_at','desc')->paginate(8);
        if ($request->ajax()) {
            $view = view('featuredproductsdata',['products' => $products])->render();
            return response()->json(['html'=>$view]);
        }
        return view('featuredproducts',['products'=>$products]);
     }


     public function getdiscount(Request $request){

        $products=DB::table('products')->join('stores', 'products.storeid', '=', 'stores.id')->where([["products.discount",'>','0']])->orderBy('products.created_at','desc')->paginate(8);
        if ($request->ajax()) {
            $view = view('flashdata',['products' => $products])->render();
            return response()->json(['html'=>$view]);
        }
     }

     public function flashsales(Request $request){

        $products=DB::table('products')->join('stores', 'products.storeid', '=', 'stores.id')->where([["products.discount",'>','0']])->orderBy('products.created_at','desc')->paginate(8);
        if ($request->ajax()) {
            $view = view('flashdata',['products' => $products])->render();
            return response()->json(['html'=>$view]);
        }
        return view('flashproducts',['products'=>$products]);
     }

     public function getmore(Request $request){

        $products=DB::table('products')->join('stores', 'products.storeid', '=', 'stores.id')->orderBy('products.created_at','desc')->paginate(12);
        if ($request->ajax()) {
            $view = view('moredata',['products' => $products])->render();
            return response()->json(['html'=>$view]);
        }
     }

     public function shop(Request $request){

        $products=DB::table('products')->join('stores', 'products.storeid', '=', 'stores.id')->orderBy('products.created_at','desc')->paginate(12);
        if ($request->ajax()) {
            $view = view('moredata',['products' => $products])->render();
            return response()->json(['html'=>$view]);
        }
        return view('shop',['products'=>$products]);
     }

     public function prodbycategories(Request $request){
        $category=category::where('id',$request->catid)->first();
        $state="";
        if($request->has('state') && $request->state!='all'){
            $state=$request->state;
        }
        if($request->has('subcatid')){
           $catid=$request->subcatid;
           if($state==""){
                $products=DB::table('products')->join('stores', 'products.storeid', '=', 'stores.id')->where('subcategory',$catid)->orderBy('products.created_at','desc')->paginate(12); 
           }else{
            $products=DB::table('products')->join('stores', 'products.storeid', '=', 'stores.id')->where([['products.subcategory','=',$catid],['stores.state','=',$state]])->orderBy('products.created_at','desc')->paginate(12); 
            } 
        }else{
            $catid=$request->catid;
            if($state==""){
                $products=DB::table('products')->join('stores', 'products.storeid', '=', 'stores.id')->where('category',$catid)->orderBy('products.created_at','desc')->paginate(12); 
           }else{
            $products=DB::table('products')->join('stores', 'products.storeid', '=', 'stores.id')->where([['products.category','=',$catid],['stores.state','=',$state]])->orderBy('products.created_at','desc')->paginate(12); 
            }
        }
        
        if ($request->ajax()) {
            $view = view('moredata',['products' => $products,'categoryname'=>$category->catname])->render();
            return response()->json(['html'=>$view]);
        }
        return view('prodbycategories',['products'=>$products,'categoryname'=>$category->catname]);
     }

     
}
