<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UserRequest;
use App\User;
use Illuminate\Http\Request;
use DataTables;

class UserController extends Controller
{

    public function index()
    {
        $user = User::all();
        return view('dashboard.users.index',compact('user'));

    }//end of index

    public function data(){

        $users = User::all();

        return DataTables::of($users)
        // ->addColumn('action',function($users){
        //     return "<a class='btn btn-xs btn-primary edit'  data-id= '$users->id' data-url='".route('categories.update',$users->id)."' data-value = '".$users->name."'><i class='glyphicon glyphicon-edit'></i>Edit</a>
        //     <a class='btn btn-xs btn-danger delete' data-url='". route('categories.destroy',$users->id) ."' data-id= '$users->id'><i class='glyphicon glyphicon-trash'></i>Delete</a>";

        // })
        ->make(true);


    }//end of data


    public function create()
    {

        return view('dashboard.users.create');

    }//end of create



    public function store(UserRequest $request)
    {

        $request['password'] = bcrypt($request->password);

        User::create($request->all());
        
        session()->flash('success', ('site.add_successfully'));

        return redirect()->route('dashboard.users.index');

    }//end of store



    public function edit(User $user)
    {

    }//end of edit


    public function update(Request $request, User $user)
    {

    }//end of update


    public function destroy(User $user)
    {

    }//end of destroy
}
