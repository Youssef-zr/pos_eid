<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    // Orders list
    public function index()
    {
        $title = trans("lang.orders");
        $orders = Order::with('client')->get();

        return view("dashboard.views.orders.index", compact('title', "orders"));
    }

    // Get ajax order products list
    public function products($id)
    {
        $order = Order::findOrFail($id);

        return view("dashboard.views.orders._ajax-products", compact('order'));
    }

    // Delete order and update products stock
    public function destroy(Order $order)
    {
        $order_products = $order->products;

        // update order products stock
        foreach ($order_products as $product) {

            $product->fill([
                "stock" => $product->stock + $product->pivot->quantity
            ])->save();
        }

        // delete order
        $order->delete();

        return redirect_with_flash("msgSuccess", trans("lang.record_deleted_successfully"), "orders");
    }
}
