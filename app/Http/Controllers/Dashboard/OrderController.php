<?php

namespace App\Http\Controllers\Dashboard;
use DataTables;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_categories'])->only(['index','show']);
        $this->middleware(['permission:delete_categories'])->only('destroy');

    }

    public function index()
    {
        return view('dashboard.orders.index');

    }//end of index

    public function data()
    {

        $orders = Order::all();
        //  dd($clients->find(5)->category_id);
        return DataTables::of($orders)
            ->addColumn('action', function ($order) {
                if (auth()->user()->can(['update_orders', 'delete_orders'], true)) {
                    return "<a class='btn btn-xs btn-success order-products'  data-url='" . route('dashboard.orders.show', $order->id) . "' data-method ='get'><i class='glyphicon glyphicon-eye-open'></i></a>
                        <a class='btn btn-xs btn-primary edit' href='" . route('dashboard.clients.orders.edit',[$order->client_id ,$order->id]) . "'><i class='glyphicon glyphicon-edit'></i></a>
                         <a class='btn btn-xs btn-danger delete'  data-id= '$order->id' data-url='" . route('dashboard.orders.destroy', $order->id) . "'><i class='glyphicon glyphicon-trash'></i></a>";
                }
                 elseif (auth()->user()->can('update_orders')) {
                    return "<a class='btn btn-xs btn-success order-products'  data-url='" . route('dashboard.orders.show', $order->id) . "' data-method ='get'><i class='glyphicon  glyphicon-eye-open'></i></a>
                        <a class='btn btn-xs btn-primary edit' href='" . route('dashboard.clients.orders.edit', [$order->client_id ,$order->id]) . "' data-value = '" . $order->name . "'><i class='glyphicon glyphicon-edit'></i></a>
                        <a class='btn btn-xs btn-danger delete disabled'><i class='glyphicon glyphicon-trash'></i></a>";
                } elseif (auth()->user()->can('delete_orders')) {
                    return "<a class='btn btn-xs btn-success order-products'  data-url='" . route('dashboard.orders.show', $order->id) . "' data-method ='get'><i class='glyphicon  glyphicon-eye-open'></i></a>
                         <a class='btn btn-xs btn-primary edit disabled'><i class='glyphicon glyphicon-edit'></i></a>
                         <a class='btn btn-xs btn-danger delete '  data-id= '$order->id' data-url='" . route('dashboard.orders.destroy', $order->id) . "'><i class='glyphicon glyphicon-trash'></i></a>";
                } else {
                    return "<a class='btn btn-xs btn-success order-products'  data-url='" . route('dashboard.orders.show', $order->id) . "' data-method ='get'><i class='glyphicon  glyphicon-eye-open'></i></a>
                        <a class='btn btn-xs btn-primary edit disabled'><i class='glyphicon glyphicon-edit'></i></a>
                         <a class='btn btn-xs btn-danger delete disabled' ><i class='glyphicon glyphicon-trash'></i></a>";
                }
            })
            ->addColumn('client_name',function($order)
            {
                return $order->client->name;
            })->editColumn('total_price',function ($order)
            {
                return number_format($order->total_price,2);
            })
            ->editColumn('created_at',function ($order)
            {
                return $order->created_at->toDateTimeString();
            })
            ->make(true);
    }

    public function show(Order $order)
    {
        $products = $order->products;
         return view('dashboard.orders._show',compact('products','order'));

    }//end of show



    public function destroy(Order $order)
    {
        foreach ($order->products as $product) {

            $product->update([
                'stock'=>$product->stock + $product->pivot->quantity
            ]);
        }
        $order->delete();
        // $products = $order->products;
        // return view('dashboard')
        return \response()->json(['status' => true, 'message' => __('site.delete_successfully')]);

    }//end of destroy

}
