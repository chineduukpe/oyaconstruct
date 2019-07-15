<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\category;
use App\subcategory;
Use App\store;
Use App\user;
Use App\product;
use App\Size;
use App\Colour;
use App\Picture;
use App\ProductPrice;


class ProductController extends Controller
{
    //
    public function addproduct(Request $request){
        // return $request->altpic[0]->getClientOriginalExtension();
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

            /*  ASSIGNING MULTIPLE SIZES TO PRODUCT
                $sizes = Size::find($request->sizes);
                $product->sizes()->attach($sizes);
            */

            $product_price = new ProductPrice();
            $product_price->product_id = $product->id;
            $product_price->size_id = $request->size;
            $product_price->price = $request->cost;
            $product_price->save();

            $colours = Colour::find($request->colours);
            $product->colours()->attach($colours);

            $new_alt_pic['productid'] = $product->id; //
            foreach ($request->altpic as $altpic) {
                $file_extension = $altpic->getClientOriginalExtension();
                $new_alt_pic['picturename'] = Time() . Auth::user()->id . substr(md5(rand()),5,5) . '.' . $file_extension;
                if (in_array(strtolower($file_extension),$exts)) {
                    if ($altpic->move(storage_path().'/app/public/productpic/',$new_alt_pic['picturename'])) {
                        Picture::create($new_alt_pic);
                    }
                }
                // return $new_alt_pic;
            }
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
        $colours = Colour::orderBy('colour','ASC')->get();
        $sizes = Size::orderBy('size','ASC')->get();
     	$products = product::where('storeid',$storeid)->paginate(2);
    	if ($request->ajax()) {
    		$view = view('admin/productdata',['products' => $products,'storeid'=>$storeid,'storestatus'=>$store->status])->render();
            return response()->json(['html'=>$view]);
        }
    	return view('admin/product',['products'=>$products,'store'=>$store,'storestatus'=>$store->status,'sizes'=>$sizes,'colours'=>$colours]);
     }

     public function singleproduct($id, Request  $request){
        //$store=store::where('id',$storeid)->first();
        $products = product::where('id',$id)->first();
        $sizes = Size::all();
        $colours = Colour::all();
        // return $products->colours();
        return view('viewproduct',compact('products'));
     }

    //  public function editproductaltpic(Request $request){
    //     try{
    //         $productid=$request->productid;
    //         $picnumber=$request->picno;
    //         $picname="";
    //         if($request->hasfile('pic'))
    //          {
    //             $exts=explode(',',"jpeg,png,jpg");
    //             $pic=$request->file('pic');
    //             $filename=$pic->getClientOriginalName();
    //             $ext=substr($filename, strpos($filename, '.'));
    //             if(!in_array(substr($ext, 1), $exts)){
    //                  return back()->with('error',"Wrong image type uploaded. Image must be of type jpeg, jpg or png");
    //             }
    //             $picname=$productid.$picnumber.".jpg";
    //             $pic->move(storage_path().'/app/public/productpic/', $picname);
    //          }else{
    //             return back()->with('error',"No image uploaded");
    //          } 

    //          //update
    //          if($picnumber==1){
    //             DB::table('products')->where('id',$productid)->update(['pic1'=>$picname]);
    //             return back()->with('success',"Alt picture 1 updated successfully");
    //          }else if($picnumber==2){
    //             DB::table('products')->where('id',$productid)->update(['pic2'=>$picname]);
    //             return back()->with('success',"Alt picture 2 updated successfully");
    //          }else if($picnumber==3){
    //             DB::table('products')->where('id',$productid)->update(['pic3'=>$picname]);
    //             return back()->with('success',"Alt picture 3 updated successfully");
    //          }else if($picnumber==4){
    //             DB::table('products')->where('id',$productid)->update(['pic4'=>$picname]);
    //             return back()->with('success',"Alt picture 4 updated successfully");
    //          }
    //     }catch(Exception $e){
    //         return back()->with('error',"A network error occured. Please try again.");
    //     }       
    //  }

    public function editproductaltpic(Request $request)
    {
        $picture_id = $request->picno;
        $image_extensions = ['jpeg','jpg','png','svg'];
        $picture_to_update = Picture::find($picture_id);
        if (!$request->hasfile('pic')) {
            return redirect()->back()->with('error','No file uploaded.');
        }
        $altpic = $request->file('pic');
        $file_extension = $altpic->getClientOriginalExtension();

        if (!in_array($file_extension,$image_extensions)) {
            return redirect()->back()->with('error','File must be an image.');
        }

        $new_alt_pic['picturename'] = Time() . Auth::user()->id . substr(md5(rand()),5,5) . '.' . $file_extension;
        try{
            if ($altpic->move(storage_path().'/app/public/productpic/',$new_alt_pic['picturename'])) {
                if (file_exists($picture_to_update->picturename)) {
                    unlink($picture_to_update->picturename);
                }
                $picture_to_update->update($new_alt_pic);
                return redirect()->back()->with('success','Alternative picture has been replaced');
            }
        }
        catch(Exception $e){
            return redirect()->back()->with('error','A network error has occured. Please try again.');
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

        $products=DB::table('products')->select('products.*','stores.id as storeid')->join('stores', 'products.storeid', '=', 'stores.id')->where("products.featured",'yes')->orderBy('products.created_at','desc')->paginate(8);
        if ($request->ajax()) {
            $view = view('featuredproductsdata',['products' => $products])->render();
            return response()->json(['html'=>$view]);
        }
     }

     public function featuredproducts(Request $request){

        $products=DB::table('products')->select('products.*','stores.id as storeid')->join('stores', 'products.storeid', '=', 'stores.id')->where("products.featured",'yes')->orderBy('products.created_at','desc')->paginate(8);
        if ($request->ajax()) {
            $view = view('featuredproductsdata',['products' => $products])->render();
            return response()->json(['html'=>$view]);
        }
        return view('featuredproducts',['products'=>$products]);
     }


     public function getdiscount(Request $request){

        $products=DB::table('products')->select('products.*','stores.id as storeid')->join('stores', 'products.storeid', '=', 'stores.id')->where([["products.discount",'>','0']])->orderBy('products.created_at','desc')->paginate(8);
        if ($request->ajax()) {
            $view = view('flashdata',['products' => $products])->render();
            return response()->json(['html'=>$view]);
        }
     }

     public function flashsales(Request $request){

        $products=DB::table('products')->select('products.*','stores.id as storeid')->join('stores', 'products.storeid', '=', 'stores.id')->where([["products.discount",'>','0']])->orderBy('products.created_at','desc')->paginate(8);
        if ($request->ajax()) {
            $view = view('flashdata',['products' => $products])->render();
            return response()->json(['html'=>$view]);
        }
        return view('flashproducts',['products'=>$products]);
     }

     public function getmore(Request $request){

        $products=DB::table('products')->select('products.*','stores.id as storeid')->join('stores', 'products.storeid', '=', 'stores.id')->orderBy('products.created_at','desc')->paginate(12);
        if ($request->ajax()) {
            $view = view('moredata',['products' => $products])->render();
            return response()->json(['html'=>$view]);
        }
     }

     public function shop(Request $request){

        $products=DB::table('products')->select('products.*','stores.id as storeid')->join('stores', 'products.storeid', '=', 'stores.id')->orderBy('products.created_at','desc')->paginate(12);
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
                $products=DB::table('products')->select('products.*','stores.id as storeid')->join('stores', 'products.storeid', '=', 'stores.id')->where('subcategory',$catid)->orderBy('products.created_at','desc')->paginate(12); 
           }else{
            $products=DB::table('products')->join('stores', 'products.storeid', '=', 'stores.id')->where([['products.subcategory','=',$catid],['stores.state','=',$state]])->orderBy('products.created_at','desc')->paginate(12); 
            } 
        }else{
            $catid=$request->catid;
            if($state==""){
                $products=DB::table('products')->select('products.*','stores.id as storeid')->join('stores', 'products.storeid', '=', 'stores.id')->where('category',$catid)->orderBy('products.created_at','desc')->paginate(12); 
           }else{
            $products=DB::table('products')->select('products.*','stores.id as storeid')->join('stores', 'products.storeid', '=', 'stores.id')->where([['products.category','=',$catid],['stores.state','=',$state]])->orderBy('products.created_at','desc')->paginate(12); 
            }
        }
        
        if ($request->ajax()) {
            $view = view('moredata',['products' => $products,'categoryname'=>$category->catname])->render();
            return response()->json(['html'=>$view]);
        }
        return view('prodbycategories',['products'=>$products,'categoryname'=>$category->catname]);
     }

     public function addProductPrice(Request $request){
        if(empty($request->price)){
            return response()->json(['error' => 'You must specify the product price']);
        }
        $product_to_update = Product::find($request->product_id);
        if(empty($product_to_update)){
            return response()->json(['error' => _('general.deleted')]);
        }
        $price_exists = ProductPrice::where('product_id',$request->product_id)->where('size_id',$request->size_id)->get()->first();
        if(!empty($price_exists)){
            return response()->json(['error' => 'The price already exist.']);
        }

        try{
            ProductPrice::create(request(['product_id','size_id','price']));
            return response()->json(['message' => __('products.updated')]);
        }
        catch (Exception $err){
            return response()->json(['error' => __('general.network-error')]);
        }

     }

     public function deleteProduct($product_id){
        if (!$product_id){
            return response()->json(['error' => 'No ID has been specified for delete operation.']);
        }

        try{
            DB::beginTransaction();
            $product_to_delete = Product::find($product_id);
            $product_to_delete->colours()->detach();
            if(!empty($product_to_delete->prices)){
                foreach ($product_to_delete->prices as $price){
                    $price->delete();
                }
            }
            if (!empty($product_to_delete->pictures)){
                foreach ($product_to_delete->pictures as $picture){
                    $picture->delete();
                }
            }
            $product_to_delete->delete();
            DB::commit();
            return response(['message' => __('products.deleted')]);
        }
        catch (Exception $e){
            DB::rollBack();
            return response()->json(['error' => __('general.network-error')]);
        }
     }
     
}
