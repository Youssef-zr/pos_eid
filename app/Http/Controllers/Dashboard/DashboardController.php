<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __constract()
    {
        $this->middleware('CheckUserStatus');
    }

    public static function index()
    {

        $products_cout = Product::count();
        $categoris_count = Category::count();
        $clients_count = Client::count();
        $users_count = User::count();
        // $admins_count = User::whereRoleIs('admin')->count();

        // get the orders total price by month
        $orders_data = Order::select(
            DB::raw("YEAR(created_at) as year"),
            DB::raw("MONTH(created_at) as month"),
            DB::raw("SUM(total_price) as sum")
        )->groupBy('month')->get();

        $chart_data =  [1 => 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        foreach ($orders_data as $order) {
            $data = array_values($order->toArray());
            $chart_data[$data[1]] = $data[2];
        }

        return view(
            "dashboard.views.index",
            compact("products_cout", "categoris_count", "clients_count", "users_count", "chart_data")
        );
    }

    public static function welcome()
    {
        return view("dashboard.views.welcome");
    }
}
