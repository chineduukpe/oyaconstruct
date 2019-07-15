<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\cart as Cart;
use App\cartproduct as CartProduct;
use App\product as Product;
use App\ProductPrice;
use App\Order;

class CartController extends Controller
{
    //
    public function addProduct(Request $request)
    {

        if (!$request->userid || !$request->session) {
            return response(['error' => 'You must be logged in to start shoping!'], 403);
        }

        if (empty($request->product_id) || empty($request->quantity)) {
            return response(['error' => 'Product ID or quantity missing. Try adding this product again.']);
        }

        try {
            $user_cart = Cart::where('userid', $request->userid)->where('cartstatus', 'pending')->get()->first();
            // Create new cart if user doesnt have a cart yet.
            if (!$user_cart) {
                $user_cart = new Cart();
                $user_cart->userid = $request->userid;
                $user_cart->cartstatus = 'pending';
                $user_cart->totalamount = 0;
                $user_cart->save();
            }

            // Get the product cost
            $product_cost = Product::find($request->product_id);

            // Create new cart Item;
            $new_cart_product = new CartProduct();
            $new_cart_product->cartid = $user_cart->id;
            $new_cart_product->productid = $request->product_id;
            $new_cart_product->sizeid = $request->size ? $request->size : null;
            $new_cart_product->colourid = $request->colour ? $request->colour : null;
            $new_cart_product->quantity = $request->quantity;
            $new_cart_product->storeid = $product_cost->storeid;

            // CALCULATE THE COST OF PRODUCT AND QUANTITY
            if (!$request->size) {
                if ($product_cost->price) {
                    $cost = (float) ($product_cost->price * $request->quantity);
                } else {
                    return response(['error' => 'Could not add the product to cart. please try again.']);
                }
            } else {
                $product_size = ProductPrice::where('product_id', $request->product_id)->where('size_id', $request->size)->get()->first()->price;
                $cost = (float) ($product_size * $request->quantity);
            }

            $new_cart_product->cost = $cost;
            $user_cart->totalamount = $user_cart->totalamount + $cost;
            $user_cart->save();


            // CALCULATE PERCENTAGE
            $commision = 0;
            if ($cost > 0 && $cost < 2500000) {
                // Get 13 percent
                $commision = (float) ($cost / 100) * 3.5;
            } elseif ($cost >= 2500000 && $cost < 10000000) {
                $commison = (float) ($cost / 100) * 3.38;
            } else {
                $commison = (float) ($cost / 100) * 3.35;
            }
            $new_cart_product->commision = $commision;
            $new_cart_product->save();
            return response(['message' => 'Product has been added to your cart.']);
        } catch (Exception $e) {
            return response(['error' => __('general.network-error')]);
        }
    }
    /*
    * END ADD PRODUCT TO CART METHOD
     */

    public function viewCart()
    {

        Auth::check() ?
            $cart = Cart::where('userid', Auth::user()->id)->where('cartstatus', 'pending')->get()->first() : $cart = array();
        $total = 0;
        if (!empty($cart) && !empty($cart->cartProducts()->first()->id)) {
            foreach ($cart->cartProducts as $cartProduct) {
                $total += $cartProduct->cost;
            }
        }
        // return $total;
        // return $cart->cartProducts;
        return view('customer.cart', compact('cart', 'total'));
    }

    public function deleteProduct($user_id, $cart_product_id)
    {
        if (empty($cart_product_id)) {
            return redirect()->back()->with('error', 'Missing item ID to remove from cart');
        }

        //  Check if product is attached to a cart
        $cartProduct = CartProduct::find($cart_product_id);
        if (empty($cartProduct)) {
            return redirect()->back()->with('error', 'The specified product does not exist.');
        }

        if (Auth::user()->id !== $cartProduct->cart()->first()->userid) {
            return redirect()->back()->with('error', 'Unauthorized operation. please make sure the product has not been deleted and try again');
        }

        try {
            $cartProduct->delete();
            return redirect()->back()->with('success', 'The product has been removed from your cart.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'A network error has occured.');
        }
    }

    public function verifyCartPaymentAmount(Request $request)
    {
        try {
            $user = \App\User::find($request->userid);
            $cart_total_amount = 0;

            foreach ($user->cart()->orderBy('created_at','DESC')->first()->cartProducts as $cartProduct) {
                $cart_total_amount += $cartProduct->cost;
            }

            return response(['amount' => $cart_total_amount]);
        } catch (Exception $e) {
            return response(['error' => 'A network error occured. Please try again.']);
        }
    }

    public function verifyPaystackPayment(Request $request)
    {

        $ref_num = $request->reference; //ref number of the transaction

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . $ref_num,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization:  Bearer sk_test_1fdaac5cb4ea126a43f433f658a00b561f9e1d47"
            ),
        ));

        $res = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            //echo "cURL Error #:" . $err;
            return view('/paystackpayment')->with(['error' => 'cURL Error #:' . $err . '. Try again.',]);
        } else {
            //if success response status is true else false, you can view response to get all about a transaction
            $response = json_decode($res, true);
            if ($response['status'] == 1) {
                $username = Auth::user()->id;
                $paymenttype = $request->paymenttype;
                //transaction was successful
                //here is some important data
                $ref = $response['data']['reference']; //reference number 
                $amount = $response['data']['amount']; //amount paid (in kobo) 
                $datepaid = date("Y/m/d H:i:s"); //$response['data']['paid_at'] date time paid at (in kobo) 
                $name = $response['data']['metadata']['custom_fields'][0]['display_name']; //name of user
                $phone = $response['data']['metadata']['custom_fields'][0]['value']; //mobile number of user

                $cart = Auth::user()->cart()->orderBy('created_at','DESC')->first();
                try {
                    DB::beginTransaction();
                    $total_commision = (float) 0;
                    $order_receipt_items = array();
                    foreach ($cart->cartProducts as $cartProduct) {
                        $cartProduct->status = 1;
                        $order_receipt_items[$cartProduct->product()->first()->productname] = $cartProduct->quantity;
                        $total_commision += $cartProduct->commision;
                        $cartProduct->save();
                    }
                    $cart->cartstatus = 'paid';
                    $order = new Order();
                    $confirmation_code = rand(1000, 9999);
                    $order->payment_type = $paymenttype ? $paymenttype : 'paystack';
                    $order->payment_amount = $amount;
                    $order->payment_total_commision = $total_commision;
                    $order->confirmation_code = $confirmation_code;
                    $order->payment_reference = $ref;
                    $order->payment_date = $datepaid;
                    $order->paid_by = $name;
                    $order->user_id = Auth::user()->id;
                    $order->delivery_phone = $phone;
                    $order->cart_id = $request->cartid;
                    $order->delivery_address = $request->address;

                    $order->save();
                    $cart->save();
                    DB::commit();
                   
                    return redirect(route('customer.orders.printreceipt',$order->id));
                } catch (Exception $e) {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'A network error occured while booking your order. Please contact our help center.');
                }
            }
        }
    }

    public function payCash(Request $request)
    {
        try {
            DB::beginTransaction();
            $address = $request->cash_delivery_address ? $request->cash_delivery_address : Auth::user()->address;
            $cart = Auth::user()->cart->where('cartstatus', 'pending')->orderBY('created_at', 'DESC')->first();

            if (empty($cart)) {
                return redirect()->back()->with('error', 'Seem you do not have an active cart. Go to our market and start shoping.');
            }
            $total_commision = (float) 0;
            $order_receipt_items = array();
            $total_amount = 0;
            foreach ($cart->cartProducts as $cartProduct) {
                $cartProduct->status = 1;
                $order_receipt_items[$cartProduct->product()->first()->productname] = $cartProduct->quantity;
                $total_commision += $cartProduct->commision;
                $cartProduct->save();
            }
            $cart->cartstatus = 'not paid';
            $order = new Order();
            $confirmation_code = rand(1000, 9999);
            $order->payment_type = 'cash';
            $order->payment_amount = $cart->totalamount;
            $order->payment_total_commision = $total_commision;
            $order->confirmation_code = $confirmation_code;
            $order->payment_reference = 0;
            $order->user_id = Auth::user()->id;
            $order->payment_date = date("Y/m/d H:i:s");
            $order->paid_by = Auth::user()->name;
            $order->delivery_phone = Auth::user()->phone;
            $order->cart_id = $cart->id;
            $order->delivery_address = $address;

            $cart->save();
            $order->save();
            DB::commit();
            return redirect(route('customer.orders.printreceipt',$order->id));
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error has occured. Please try again. Contact oyaconstruct if this issue persist.');
        }
    }

    public function printReceipt($order_id)
    {
        $order = Order::find($order_id);
        if (!$order) {
            return redirect(route('customer.orders.view'))->with('error','Looks like the item has been delete or moved permanently');
        }

        if (Auth::user()->id != $order->user_id) {
            return redirect(route('customer.orders.view'))->with('error','Looks like the item has been deleted or moved permanently');
        }

        return view('customer.printreceipt',compact('order'));
    }
}
