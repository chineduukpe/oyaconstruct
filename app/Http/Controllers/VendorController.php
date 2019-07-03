<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Store;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VendorController extends Controller
{
    //

    public function validateInputs(Request $request)
    {
        $request->validate([
            'ownername' => 'string|required|min:3',
            'ownerphone' => 'string|required',
            'owneraddress' => 'string|required',
            'city' => 'string|required',
            'state' => 'string|required',
        ]);
    }

    public function storeExist()
    {
        $store = Store::where('owneremail',Auth::user()->email)->get()->first();
        if(!$store){
            return redirect()->back()->with('error',__('store.not-found'));
        }
        return $store;
    }

    public function APIError($message)
    {
        return response(['error' => $message],404);
    }

    public function index()
    {
        $this->storeExist();
        return view('vendor.index');
    }

    public function register(Request $request)
    {
        $this->validateInputs($request);

        /*
        * CHECK IF STORE EXIST FOR THE EMAIL
        */ 
        $store = Store::where('owneremail',Auth::user()->email)->get()->first();

        if ($store) {
            return redirect()->back()->with('error',__('store.email-exist'));
        }
        /*
        * CHECK IF STORE EXIST FOR THE EMAIL
        */ 
        $store = Store::where('ownerphone',$request->ownerphone)->get()->first();
        if ($store) {
            return redirect()->back()->with('error',__('store.phone-exist'));            
        }

        try{
            DB::beginTransaction();
            $request['owneremail'] = Auth::user()->email;
            Store::create(request([
                'ownername',
                'ownerphone',
                'owneraddress',
                'owneremail',
                'city',
                'state',
                'idcardno',
                'idcardtype'
            ]));
            DB::commit();
            return redirect()->back()->with('success',__('store.create-success'));
        }
        catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error',__('store.create-failed'));
        }

    }

    public function update(Request $request,$store_id)
    {
        $this->validateInputs($request);

        /*
        * CHECK IF THE NEW EMAIL IS ASSIGNED TO ANOTHER STORE
        */ 
        if (!empty($request->businessemail)) {
            $find_assoc_store = Store::where('businessemail',$request->businessemail)->get()->first();
                if ($find_assoc_store) {
                    if ($store_id != $find_assoc_store->id) {
                    return redirect()->back()->with('error',__('store.email-exist'));
                }
            }
        }
        /*
        * CHECK IF THE NEW PHONE IS ASSIGNED TO ANOTHER STORE
        */ 
        $find_assoc_store = Store::where('ownerphone',$request->ownerphone)->get()->first();
        if ($find_assoc_store) {
            if ($store_id != $find_assoc_store->id) {
                return redirect()->back()->with('error',__('store.phone-exist'));
            }
        }

        $store_to_update = Store::find($store_id);
        if (!$store_to_update) {
            return redirect()->back()->with('error',__('store.not-found'));
        }
        
        if ($request->status != 0 && ($store_to_update->status != $request->status) && Auth::user()->role == 'admin') {
            $store_to_update->approvedby = Auth::user()->id;
        }
        
        /*
        * CAST THE STATUS TO INTEGER AS TYPE OF DB IS INTEGER AND HTML SELECT RETURN STRING
        */ 
        $store_to_update->status = (int) $request->status;

        try{
            $store_to_update->update($request->all());
            return redirect()->back()->with('success',__('store.update-success'));
        }
        catch(Exception $e){
            Log::info('Admin Could not update store: ',[
                'store_id' => $store_id,
                'admin_id' => $Auth::user()->id,
                'error' => $e
            ]);
            return redirect()->back()->with('error',__('store.update-failed'));
        }
    }

    public function settings()
    {
        $store = $this->storeExist();
        return view('vendor.settings',compact('store'));
    }

    public function products()
    {
        $store_id = Store::where('owneremail',Auth::user()->email)->get()->first()->id;
        $products = Product::where('storeid',$store_id)->orderBy('created_at','DESC')->paginate(2)->onEachSide(2);
        // return $products;
        return view('vendor.products')->with(['products' => $products]);
    }

    public function singleProductAPI($product_id)
    {
        if (!$product_id) {
            return $this->APIError(__('products.empty-id'));
        }

        $product = Product::find($product_id);
        if(!$product){
            return $this->APIError(__('products.not-found'));
        }
        return response($product, 201);
    }

    public function updateProductQuantityAPI(Request $request)
    {
        if (!$request->product) {
            return $this->APIError(__('products.empty-id'));
        }

        $product_to_update = Product::find($request->product);
        
        if (!$product_to_update) {
            return $this->APIError(__('products.not-found'));
        }

        $product_to_update->quantity = $product_to_update->quantity + $request->amount;
        try{
            $product_to_update->save();
            return response(
                [
                    'message' => 'Product quantity has been changed! New quantity: ' . $product_to_update->quantity, 
                    'quantity' => $product_to_update->quantity
                ],200);
        }
        catch(Exception $e){
            return $this->APIError(__('products.update-error'));
        }

    }

    public function orders()
    {
        return view('vendor.orders');
    }

}

