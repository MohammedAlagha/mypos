<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Client;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){

        $products_count=Product::count();
        $categories_count=Category::count();
        $clients_count=Client::count();
        $orders_count=Order::count();

        // $sales_data =  Order::select(
        //     DB::raw('YEAR(created_at) as year'),
        //     DB::raw('MONTH(created_at) as month'),
        //     DB::raw('SUM(total_price) as total_price')
        // )->groupBy('month')->get();

        // dd($sales_data);

        return view('dashboard.welcome',compact('products_count','categories_count','clients_count','orders_count'));
    }
}
