<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:read_categories'])->only('index');
        $this->middleware(['permission:create_categories'])->only('create');
        $this->middleware(['permission:update_categories'])->only('edit');
        $this->middleware(['permission:delete_categories'])->only('destroy');

    }

    public function index()
    {
        return view('dashboard.categories.index');
    }

    public function data(){

        $categories = Category::all();
        //  dd($categories);
        return DataTables::of($categories)
        ->addColumn('action',function($category){

            if (auth()->user()->can(['update_categories','delete_categories'],true)) {
                return "<a class='btn btn-xs btn-primary edit' href='".route('dashboard.categories.edit',$category->id)."' data-value = '".$category->name."'><i class='glyphicon glyphicon-edit'></i></a>
                         <a class='btn btn-xs btn-danger delete'  data-id= '$category->id' data-url='". route('dashboard.categories.destroy',$category->id) ."'><i class='glyphicon glyphicon-trash'></i></a>";

            }elseif(auth()->user()->can('update_categories')){
                return "<a class='btn btn-xs btn-primary edit' href='".route('dashboard.categories.edit',$category->id)."' data-value = '".$category->name."'><i class='glyphicon glyphicon-edit'></i></a>
                <a class='btn btn-xs btn-danger delete'><i class='glyphicon glyphicon-trash'></i></a>";

            }elseif(auth()->user()->can('delete_categories')){
                 return "<a class='btn btn-xs btn-primary edit'><i class='glyphicon glyphicon-edit'></i></a>
                     <a class='btn btn-xs btn-danger delete'  data-id= '$category->id' data-url='". route('dashboard.categories.destroy',$category->id) ."'><i class='glyphicon glyphicon-trash'></i></a>";

            }else {
                return "<a class='btn btn-xs btn-primary edit'><i class='glyphicon glyphicon-edit'></i></a>
                <a class='btn btn-xs btn-danger delete' ><i class='glyphicon glyphicon-trash'></i></a>";

            }

        })->make(true);


    }//end of data



    public function create()
    {
        return view('dashboard.categories.create');

    }




    public function store(Request $request)
    {
        $category = Category::create($request->all());


        $request->session()->flash('success', __('site.add_successfully'));

        return redirect()->route('dashboard.categories.index');
    }


    public function show(Category $category)
    {
        //
    }


    public function edit(Category $category)
    {
        return view("dashboard.categories.edit",compact('category'));


    }


    public function update(Request $request, Category $category)
    {



        $category ->update($request->all());
        $request->session()->flash('success', __('site.edit_successfully'));

        return redirect()->route('dashboard.categories.index');

    }

    public function destroy(Category $category)
    {

        $category->delete();

        return \response()->json(['status'=>true,'message'=>__('site.delete_successfully')]);

    }
}
