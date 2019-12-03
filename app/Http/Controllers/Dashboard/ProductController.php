<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProductRequest;
use App\Product;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;


class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:read_categories'])->only(['index','show']);
        $this->middleware(['permission:create_categories'])->only('create');
        $this->middleware(['permission:update_categories'])->only('edit');
        $this->middleware(['permission:delete_categories'])->only('destroy');

    }

    public function index()
    {
        return view('dashboard.products.index');
    }//end of index

    public function data()
    {

        $products = Product::with('category:id')->get();
        //  dd($products->find(5)->category_id);
        return DataTables::of($products)
        ->addColumn('action',function($product){

            if (auth()->user()->can(['update_products','delete_products'],true)) {
                return "<a class='btn btn-xs btn-success '  href='". route('dashboard.products.show',$product->id) ."'><i class='glyphicon glyphicon-eye-open'></i></a>
                        <a class='btn btn-xs btn-primary edit' href='".route('dashboard.products.edit',$product->id)."' data-value = '".$product->name."'><i class='glyphicon glyphicon-edit'></i></a>
                         <a class='btn btn-xs btn-danger delete'  data-id= '$product->id' data-url='". route('dashboard.products.destroy',$product->id) ."'><i class='glyphicon glyphicon-trash'></i></a>";

            }elseif(auth()->user()->can('update_products')){
                return "<a class='btn btn-xs btn-success '  data-url='". route('dashboard.products.show',$product->id) ."'><i class='glyphicon  glyphicon-eye-open'></i></a>
                        <a class='btn btn-xs btn-primary edit' href='".route('dashboard.products.edit',$product->id)."' data-value = '".$product->name."'><i class='glyphicon glyphicon-edit'></i></a>
                        <a class='btn btn-xs btn-danger delete disabled'><i class='glyphicon glyphicon-trash'></i></a>";

            }elseif(auth()->user()->can('delete_products')){
                 return "<a class='btn btn-xs btnsuccessr edit '  data-url='". route('dashboard.products.show',$product->id) ."'><i class='glyphicon  glyphicon-eye-open'></i></a>
                         <a class='btn btn-xs btn-primary edit disabled'><i class='glyphicon glyphicon-edit'></i></a>
                         <a class='btn btn-xs btn-danger delete '  data-id= '$product->id' data-url='". route('dashboard.products.destroy',$product->id) ."'><i class='glyphicon glyphicon-trash'></i></a>";

            }else {
                return "<a class='btn btn-xs btn-success delete'  data-url='". route('dashboard.products.show',$product->id) ."'><i class='glyphicon  glyphicon-eye-open'></i></a>
                         <a class='btn btn-xs btn-primary edit disabled'><i class='glyphicon glyphicon-edit'></i></a>
                         <a class='btn btn-xs btn-danger delete disabled' ><i class='glyphicon glyphicon-trash'></i></a>";

            }

        })->addColumn('category',function($product){
            return $product->category->translate(app()->getLocale())->name;
        })->addColumn('profit_percent',function($product){
            return $product->profit_percent;
        })
        ->make(true);


    }//end of data


    public function create()
    {
        $categories = Category::all();

        return view('dashboard.products.create',compact('categories'));
    }//end of create


    public function show(Product $product)
    {

        return view('dashboard.products.show',compact('product'));
    }//end of create


    public function store(ProductRequest $request)
    {

        $request_data  = $request->except('image');

        if ($request->image) {
            Image::make($request->image)->resize(300,null,function($constraint){
                $constraint->aspectRatio();
            })->save(public_path('uploads/product_images/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();

        }
        Product::create($request_data);

        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.products.index');

    }//end of store



    public function edit(Product $product)

    {
        $categories = Category::all();
        return view("dashboard.products.edit",compact('product','categories'));
    }//end of edit


    public function update(ProductRequest $request, Product $product)
    {

        $request_data = $request->except('image');

        if ($request->image) {
            if ($request->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/product_images/'. $product->image);
            }
            Image::make($request->image)->resize(300,null,function($constraint){
                $constraint->aspectRatio();
            })->save(public_path('uploads/product_images/'.$request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }

        $product->update($request_data);
        $request->session()->flash('success', __('site.edit_successfully'));

        return redirect()->route('dashboard.products.index');

    }//end of update


    public function destroy(Product $product)
    {
        $product->delete();

        return \response()->json(['status'=>true,'message'=>__('site.delete_successfully')]);
    }//end of destroy
}
