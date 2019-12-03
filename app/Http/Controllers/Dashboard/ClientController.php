<?php

namespace App\Http\Controllers\Dashboard;

use App\Client;
use DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ClientRequest;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index()
    {
        return view('dashboard.clients.index');
    }

    public function data()
    {
        $clients = Client::all();
        //  dd($clients->find(5)->category_id);
        return DataTables::of($clients)
            ->addColumn('action', function ($client) {

                if (auth()->user()->can(['update_clients', 'delete_clients'], true)) {
                    return "<a class='btn btn-xs btn-success '  href='" . route('dashboard.clients.show', $client->id) . "'><i class='glyphicon glyphicon-eye-open'></i></a>
                        <a class='btn btn-xs btn-primary edit' href='" . route('dashboard.clients.edit', $client->id) . "' data-value = '" . $client->name . "'><i class='glyphicon glyphicon-edit'></i></a>
                         <a class='btn btn-xs btn-danger delete'  data-id= '$client->id' data-url='" . route('dashboard.clients.destroy', $client->id) . "'><i class='glyphicon glyphicon-trash'></i></a>";
                } elseif (auth()->user()->can('update_clients')) {
                    return "<a class='btn btn-xs btn-success '  data-url='" . route('dashboard.clients.show', $client->id) . "'><i class='glyphicon  glyphicon-eye-open'></i></a>
                        <a class='btn btn-xs btn-primary edit' href='" . route('dashboard.clients.edit', $client->id) . "' data-value = '" . $client->name . "'><i class='glyphicon glyphicon-edit'></i></a>
                        <a class='btn btn-xs btn-danger delete'><i class='glyphicon glyphicon-trash'></i></a>";
                } elseif (auth()->user()->can('delete_clients')) {
                    return "<a class='btn btn-xs btnsuccessr edit'  data-url='" . route('dashboard.clients.show', $client->id) . "'><i class='glyphicon  glyphicon-eye-open'></i></a>
                         <a class='btn btn-xs btn-primary edit'><i class='glyphicon glyphicon-edit'></i></a>
                         <a class='btn btn-xs btn-danger delete'  data-id= '$client->id' data-url='" . route('dashboard.clients.destroy', $client->id) . "'><i class='glyphicon glyphicon-trash'></i></a>";
                } else {
                    return "<a class='btn btn-xs btn-success delete'  data-url='" . route('dashboard.clients.show', $client->id) . "'><i class='glyphicon  glyphicon-eye-open'></i></a>
                        <a class='btn btn-xs btn-primary edit'><i class='glyphicon glyphicon-edit'></i></a>
                         <a class='btn btn-xs btn-danger delete' ><i class='glyphicon glyphicon-trash'></i></a>";
                }
            })
            ->make(true);
    }


    public function create()
    {
        return view('dashboard.clients.create');
    }


    public function store(ClientRequest $request)
    {
        Client::create($request->all());
        $request->session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.clients.index');
    }


    public function show(Client $client)
    {
        return view('dashboard.clients.show', compact('client'));
    }


    public function edit(Client $client)
    {
        return view('dashboard.clients.edit', compact('client'));
    }


    public function update(ClientRequest $request, Client $client)
    {
        $client->update($request->all());
        $request->session()->flash('success', __('site.edit_successfully'));

        return redirect()->route('dashboard.clients.index');
    }


    public function destroy(Client $client)
    {
        $client->delete();

        return \response()->json(['status' => true, 'message' => __('site.delete_successfully')]);
    }
}
