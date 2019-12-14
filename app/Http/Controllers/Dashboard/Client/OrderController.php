<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Category;
use App\Http\Controllers\Controller;
use App\Order;
use App\Client;
use App\Http\Requests\Dashboard\OrderRequest;
use App\Product;
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


    public function store(OrderRequest $request, Client $client)
    {

        $order = $client->orders()->create();
        $order->products()->attach($request->products);

        $total_price = 0;

        foreach ($request->products as $id => $quantity) {

            $product = Product::findOrFail($id);

            $total_price +=$product->sale_price * $quantity['quantity'];

            $product->update([
                'stock' => $product->stock - $quantity['quantity']
            ]);

        }//end of foreach

        $order->update([
            'total_price'=>$total_price
        ]);

        session()->flash('success',__('site.added_successfully'));
        return redirect()->route('dashboard.orders.index');

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
