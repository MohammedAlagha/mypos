<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DataTables;
use Intervention\Image\Facades\Image as Image;


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
        return view('dashboard.users.index');

    }//end of index

    public function data(){

        $users = User::WhereRoleIs('admin')->get();

        return DataTables::of($users)
        ->addColumn('action',function($user){

            if (auth()->user()->can(['update_users','delete_users'],true)) {
                return "<a class='btn btn-xs btn-success ' href='".route('dashboard.users.show',$user->id)."' data-value = '".$user->name."'><i class='glyphicon glyphicon-eye-open'></i></a>
                <a class='btn btn-xs btn-primary edit' href='".route('dashboard.users.edit',$user->id)."' data-value = '".$user->name."'><i class='glyphicon glyphicon-edit'></i></a>
                         <a class='btn btn-xs btn-danger delete'  data-id= '$user->id' data-url='". route('dashboard.users.destroy',$user->id) ."'><i class='glyphicon glyphicon-trash'></i></a>";

            }elseif(auth()->user()->can('update_users')){
                return "
                <a class='btn btn-xs btn-success ' href='".route('dashboard.users.show',$user->id)."' data-value = '".$user->name."'><i class='glyphicon glyphicon-eye-open'></i></a>
                <a class='btn btn-xs btn-primary edit' href='".route('dashboard.users.edit',$user->id)."' data-value = '".$user->name."'><i class='glyphicon glyphicon-edit'></i></a>
                <a class='btn btn-xs btn-danger delete disabled'><i class='glyphicon glyphicon-trash'></i></a>";

            }elseif(auth()->user()->can('delete_users')){
                 return "<a class='btn btn-xs btn-success ' href='".route('dashboard.users.show',$user->id)."' data-value = '".$user->name."'><i class='glyphicon glyphicon-eye-open'></i></a>
                 <a class='btn btn-xs btn-primary edit disabled'><i class='glyphicon glyphicon-edit'></i></a>
                     <a class='btn btn-xs btn-danger delete'  data-id= '$user->id' data-url='". route('dashboard.users.destroy',$user->id) ."'><i class='glyphicon glyphicon-trash'></i></a>";

            }else {
                return "<a class='btn btn-xs btn-success ' href='".route('dashboard.users.show',$user->id)."' data-value = '".$user->name."'><i class='glyphicon glyphicon-eye-open'></i>show
                <a class='btn btn-xs btn-primary edit disabled'><i class='gleyescon glyphicon-edit'></i></a>
                <a class='btn btn-xs btn-danger delete disabled' ><i class='glyphicon glyphicon-trash'></i></a>";

            }
        // ->addColumn('action',function($users){
        //     return "<a class='btn btn-xs btn-primary edit'  data-id= '$users->id' data-url='".route('dashboard.users.edit',$users->id)."' data-value = '".$users->name."'><i class='glyphicon glyphicon-edit'></i></a>
        //            <a class='btn btn-xs btn-danger delete'  data-url='". route('dashboard.users.destroy',$users->id) ."' data-id= '$users->id'><i class='glyphicon glyphicon-trash'></i></a>";
        // })
        })
        ->editColumn('image',function($user){
            // return "<img src='".$user->image_path."' style='width:100px;' class='img-thumbnail' >";
        })
        ->make(true);


    }//end of data


    public function create()
    {

        return view('dashboard.users.create');

    }//end of create



    public function store(UserRequest $request)
    {
        //  dd($request->image);

        $request_data = $request->except(['password','password_confirmation','permissions','image']);
        $request_data['password'] = bcrypt($request->password);

        if($request->image){
            Image::make($request->image)->resize(300,null,function($constraint){
                $constraint->aspectRatio();
            })->save(public_path('uploads/user_images/'. $request->image->hashName()));

            $request_data['image']= $request->image->hashName();
        }




        $user = User::create($request_data);

        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);
        $request->session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.users.index');

    }//end of store

    public function show(User $user)
    {
        return view('dashboard.users.show',compact('user'));
    }



    public function edit(User $user)
    {
        return view("dashboard.users.edit",compact('user'));
    }//end of edit


    public function update(UserRequest $request, User $user)
    {
        $request_data = $request->except(['permission','image']);

        if($request->image){
            if($request->image != 'default.png'){
                Storage::disk('public_uploads')->delete('/user_images/' . $user->image);
            }
                Image::make($request->image)->resize(300,null,function($constraint){
                    $constraint->aspectRatio();
                })->save(public_path('uploads/user_images/'. $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }

        // dd($request->all());
        $user ->update($request_data);
        $user->syncPermissions($request->permissions);
        $request->session()->flash('success', __('site.edit_successfully'));

        return redirect()->route('dashboard.users.index');



    }//end of update


    public function destroy(User $user)
    {

        if($user->image != 'default.png'){

            Storage::disk('public_uploads')->delete('/user_images/' . $user->image);
        }//end of if
        $user->delete();

        return \response()->json(['status'=>true,'message'=>__('site.delete_successfully')]);

    }//end of destroy
}
