<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Category;
use App\Http\Controllers\Controller;
use App\Order;
use App\Client;
use Illuminate\Http\Request;
class OrderController extends Controller
{

    public function index()
    {

    }//end of index


    public function create(Client $client)
    {
        $categories = Category::with('products')->get();
        return view("dashboard.clients.orders.create",compact('categories','client'));
    }//end of create


    public function store(Request $request, Client $client)
    {

    }//end of store


    public function show(Order $order , Client $client)
    {

    }//end of show


    public function edit(Order $order , Client $client)
    {

    }//end of edit



    public function update(Request $request, Order $order , Client $client)
    {

    }//end of update


    public function destroy(Order $order , Client $client)
    {

    }//end of destroy
}
