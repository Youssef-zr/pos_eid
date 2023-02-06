<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\client\ClientOrderRequest;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function create(Client $client)
    {
        $title = trans('lang.orders_new');
        $categories = Category::whereHas('products')
            ->with('products')->get();

        return view("dashboard.views.clients.orders.create", compact("title", "client", "categories"));
    }

    public function store(ClientOrderRequest $request, Client $client)
    {
        // attach order with products
        $this->attachOrder($request, $client);

        return redirect_with_flash("msgSuccess", trans("lang.record_added_successfully"), 'orders');
    }

    public function edit(Client $client, Order $order)
    {
        $title = trans("lang.edit_order");
        $categories = Category::whereHas('products')
            ->with('products')->get();

        // get client orders except current order
        $orders = $client->orders->except($order->id);

        return view('dashboard.views.clients.orders.update', compact('title', "order", "client", "categories", "orders"));
    }

    public function update(ClientOrderRequest $request, Client $client, Order $order)
    {
        // dettach order and update products stock
        $this->detachOrder($order);

        // attach order with products
        $this->attachOrder($request, $client);

        return redirect_with_flash("msgSuccess", trans('lang.record_updated_successfully'), "orders");
    }

    // attach order products
    private function attachOrder($request, $client)
    {
        // products list ids with quantities
        $products = $request->products;

        // create new order
        $order = $client->orders()->create([]);

        // attach products to order
        $order->products()->attach($products);

        // calculate total price and update product stock qty
        $total_price = 0;

        foreach ($products as $id => $quantity) {

            $product = Product::findOrFail($id);
            $total_price += $product->sale_price * $quantity["quantity"];

            // update product stock quantity
            $product->fill(["stock" => $product->stock - $quantity['quantity']])->save();
        }

        // update order total price
        $order->fill(['total_price' => $total_price])->save();
    }

    // detach order
    private function detachOrder($order)
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
    }
}
