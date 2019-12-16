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
        $orders = $client->orders()->with('products')->paginate(5);  //for previous orders
        return view("dashboard.clients.orders.create",compact('categories','client','orders'));
    }//end of create


    public function store(OrderRequest $request, Client $client)
    {

        $this->attach_odrer($request,$client);

        session()->flash('success',__('site.added_successfully'));
        return redirect()->route('dashboard.orders.index');

    }//end of store


    public function edit(Client $client, Order $order )
    {

        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);  //for previous orders
        return view("dashboard.clients.orders.edit",compact('categories','client','order','orders'));

    }//end of edit


    public function update(OrderRequest $request,  Client $client ,Order $order )
    {
        $this->detach_order($order);

        $this->attach_odrer($request,$client);

        session()->flash('success',__('site.edit_successfully'));

        return redirect()->route('dashboard.orders.index');
    }//end of update


    public function attach_odrer(OrderRequest $request, Client $client)
    {
        $order = $client->orders()->create([]);
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
    }

    private function detach_order($order)
    {
        foreach ($order->products as $product) {

            $product->update([
                'stock'=>$product->stock + $product->pivot->quantity
            ]);
        }
        $order->delete();
    }
}
