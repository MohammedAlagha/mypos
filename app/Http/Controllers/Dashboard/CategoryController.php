<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CategoryRequest;
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

    public function data()
    {

        $categories = Category::all();
        //  dd($categories);
        return DataTables::of($categories)
        ->addColumn('action',function($category){

            if (auth()->user()->can(['update_categories','delete_categories'],true)) {
                return "<a class='btn btn-xs btn-primary edit' href='".route('dashboard.categories.edit',$category->id)."' data-value = '".$category->name."'><i class='glyphicon glyphicon-edit'></i></a>
                         <a class='btn btn-xs btn-danger delete'  data-id= '$category->id' data-url='". route('dashboard.categories.destroy',$category->id) ."'><i class='glyphicon glyphicon-trash'></i></a>";

            }elseif(auth()->user()->can('update_categories')){
                return "<a class='btn btn-xs btn-primary edit' href='".route('dashboard.categories.edit',$category->id)."' data-value = '".$category->name."'><i class='glyphicon glyphicon-edit'></i></a>
                <a class='btn btn-xs btn-danger delete disabled'><i class='glyphicon glyphicon-trash'></i></a>";

            }elseif(auth()->user()->can('delete_categories')){
                 return "<a class='btn btn-xs btn-primary edit disabled'><i class='glyphicon glyphicon-edit'></i></a>
                     <a class='btn btn-xs btn-danger delete'  data-id= '$category->id' data-url='". route('dashboard.categories.destroy',$category->id) ."'><i class='glyphicon glyphicon-trash'></i></a>";

            }else {
                return "<a class='btn btn-xs btn-primary edit disabled'><i class='glyphicon glyphicon-edit'></i></a>
                <a class='btn btn-xs btn-danger delete disabled' ><i class='glyphicon glyphicon-trash'></i></a>";

            }

        })->make(true);


    }//end of data



    public function create()
    {
        return view('dashboard.categories.create');

    }




    public function store(CategoryRequest $request)
    {

        Category::create($request->all());
        // dd($request->all());

        session()->flash('success', __('site.added_successfully'));

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


    public function update(CategoryRequest $request, Category $category)
    {



        $category->update($request->all());
        $request->session()->flash('success', __('site.edit_successfully'));

        return redirect()->route('dashboard.categories.index');

    }

    public function destroy(Category $category)
    {
        if($category->image != 'default.png'){

            Storage::disk('public_uploads')->delete('/product_images/' . $category->image);
        }//end of if
        $category->delete();

        return \response()->json(['status'=>true,'message'=> __('site.delete_successfully')]);

    }
}
