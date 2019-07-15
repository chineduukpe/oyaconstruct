<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Order;

class AdminOrderController extends Controller
{
    //
    public function viewAll()
    {
        $orders = Order::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.vieworders', compact('orders'));
    }

    public function cancelOrder(Request $request)
    {
        if (empty($request->order_id)) {
            return redirect(route('admin.orders.view'))->with('error', 'No ID specified for order.');
        }

        $order = Order::find($request->order_id);

        if (!$order) {
            return redirect(route('admin.orders.view'))->with('error', 'The order could not be found. Make sure it has not been deleted by another user and try again.');
        }

        try {
            $order->delete();
            return redirect(route('admin.orders.view'))->with('success', 'Order has been deleted successfully');
        } catch (Exception $e) {
            return redirect(route('admin.orders.view'))->with('error', 'A network error has occured. Please try again.');
        }
    }

    public function deliverOrder(Request $request)
    {
        if (empty($request->orderid)) {
            return response(['error', 'No ID specified for the item.']);
        }
        try {
            DB::beginTransaction();
            $order = Order::findOrFail($request->orderid);
            $order->delivery_status = 1;
            $order->approved_by = $request->approved_by;
            if ($order->payment_type == 'cash') {
                $order->cart->cartstatus = 'paid';
                $order->cart->save();
                foreach ($order->cart->cartProducts as $cartProduct) {
                    $cartProduct->status = 1;
                    $product = $cartProduct->product()->first();
                    $product->nosold = $product->nosold + 1;
                    $product->save();
                    $cartProduct->save();
                }
            } else {
                foreach ($order->cart->cartProducts as $cartProduct) {
                    $product = $cartProduct->product()->first();
                    $product->nosold = $product->nosold + 1;
                    $product->save();
                    $cartProduct->save();
                }
            }
            $order->save();
            DB::commit();
            return response(['message' => 'Order has been deliverd successfully!']);
        } catch (Exception $e) {
            DB::rollBack();
            return response(['error', 'Seems like a network error has occured. Please try again.'], 500);
        }
    }
}
