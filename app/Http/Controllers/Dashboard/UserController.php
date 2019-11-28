<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UserRequest;
use App\User;
use Illuminate\Http\Request;
use DataTables;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:delete_users'])->only('destroy');

    }

    public function index()
    {
        $user = User::all();
        return view('dashboard.users.index',compact('user'));

    }//end of index

    public function data(){

        $users = User::all();

        return DataTables::of($users)
        ->addColumn('action',function($users){

            if (auth()->user()->can(['update_users','delete_users'],true)) {
                return "<a class='btn btn-xs btn-primary edit' href='".route('dashboard.users.edit',$users->id)."' data-value = '".$users->name."'><i class='glyphicon glyphicon-edit'></i></a>
                         <a class='btn btn-xs btn-danger delete'  data-id= '$users->id' data-url='". route('dashboard.users.destroy',$users->id) ."'><i class='glyphicon glyphicon-trash'></i></a>";

            }elseif(auth()->user()->can('update_users')){
                return "<a class='btn btn-xs btn-primary edit' href='".route('dashboard.users.edit',$users->id)."' data-value = '".$users->name."'><i class='glyphicon glyphicon-edit'></i></a>
                <a class='btn btn-xs btn-danger delete'><i class='glyphicon glyphicon-trash'></i></a>";

            }elseif(auth()->user()->can('delete_users')){
                 return "<a class='btn btn-xs btn-primary edit'><i class='glyphicon glyphicon-edit'></i></a>
                     <a class='btn btn-xs btn-danger delete'  data-id= '$users->id' data-url='". route('dashboard.users.destroy',$users->id) ."'><i class='glyphicon glyphicon-trash'></i></a>";

            }else {
                return "<a class='btn btn-xs btn-primary edit'><i class='glyphicon glyphicon-edit'></i></a>
                <a class='btn btn-xs btn-danger delete' ><i class='glyphicon glyphicon-trash'></i></a>";

            }
        // ->addColumn('action',function($users){
        //     return "<a class='btn btn-xs btn-primary edit'  data-id= '$users->id' data-url='".route('dashboard.users.edit',$users->id)."' data-value = '".$users->name."'><i class='glyphicon glyphicon-edit'></i></a>
        //            <a class='btn btn-xs btn-danger delete'  data-url='". route('dashboard.users.destroy',$users->id) ."' data-id= '$users->id'><i class='glyphicon glyphicon-trash'></i></a>";
        // })
        })->make(true);


    }//end of data


    public function create()
    {

        return view('dashboard.users.create');

    }//end of create



    public function store(UserRequest $request)
    {

        $request['password'] = bcrypt($request->password);

        $user = User::create($request->all());

        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);
        $request->session()->flash('success', __('site.add_successfully'));

        return redirect()->route('dashboard.users.index');

    }//end of store



    public function edit(User $user)
    {
        return view("dashboard.users.edit",compact('user'));
    }//end of edit


    public function update(Request $request, User $user)
    {
        // dd($request->all());
        $user ->update($request->all());
        $user->syncPermissions($request->permissions);
        $request->session()->flash('success', __('site.edit_successfully'));

        return redirect()->route('dashboard.users.index');



    }//end of update


    public function destroy(User $user)
    {

    }//end of destroy
}
