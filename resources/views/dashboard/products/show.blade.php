@extends('layouts.dashboard.app')

@section('content')

<div class="pageheader">
    <h2><i class="glyphicon glyphicon-user"></i> @lang('site.products') <span>@lang('site.product_show') {{$product->translate(app()->getLocale())->name}}</span></h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.products.show',[$product->id])}}">@lang('site.product_show') {{$product->translate(app()->getLocale())->name}}</a></li>
            <li><a href="{{route('dashboard.products.index')}}">@lang('site.products')</a></li>
            <li class="active">@lang('site.dashboard')</li>
        </ol>
    </div>
</div>

<div class="contentpanel">

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-btns">
                <a href="" class="panel-close">&times;</a>
                <a href="" class="minimize">&minus;</a>
            </div>
        <h4 class="panel-title">@lang('site.product_show') {{$product->translate(app()->getLocale())->name}}</h4>

        </div>
        <div class="panel-body panel-body-nopadding">


            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                            <label class="col-sm-3 control-label">@lang('site.category')</label>
                            <div class="col-sm-6">
                            <input type="text" name='category_id' placeholder="" value="{{$product->category->name}}" class="form-control" readonly="readonly" />
                            </div>
                        </div>

                    @foreach (config('translatable.locales') as $locale)

                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.'.$locale.'.name')</label>
                        <div class="col-sm-6">
                        <input type="text" name='{{$locale}}[name]' placeholder="" value="{{$product->translate($locale)->name}}" class="form-control" readonly="readonly" />
                        </div>
                    </div>

                    <div class="form-group">
                            <label class="col-sm-3 control-label">@lang('site.'.$locale.'.decription')</label>
                            <div class="col-sm-9">
                            <textarea name='{{$locale}}[description]' placeholder="" cols="5" rows="6" class="form-control "  readonly >{!! $product->translate($locale)->description !!}</textarea>
                            </div>
                        </div>

                    @endforeach



                    <div class="form-group offset-md-4">
                            <label class="col-sm-4 control-label"></label>
                            <div class="col-sm-6">
                                <img src="{{$product->image_path}}" alt="" style="size:100px" class="img-thumbnail" id="image-preview">
                            </div>
                    </div>


                     <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.purchase_price')</label>
                        <div class="col-sm-6">
                            <input type="number" name='' placeholder="" value="{{$product->purchase_price}}" class="form-control"  readonly="readonly" />
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.sale_price')</label>
                        <div class="col-sm-6">
                            <input type="number" name='' placeholder="" value="{{$product->sale_price}}" class="form-control"  readonly="readonly" />
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.profit')</label>
                        <div class="col-sm-6">
                            <input type="number" name='' placeholder="" value="{{$product->profit}}" class="form-control"  readonly="readonly" />
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.profit_percent')</label>
                        <div class="col-sm-6">
                            <input type="number" name='' placeholder="" value="{{$product->profit_percent}}" class="form-control"  readonly="readonly" />
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.stock')</label>
                        <div class="col-sm-6">
                             <input type="number" name='' placeholder="" value="{{$product->stock}}" class="form-control"  readonly="readonly" />
                        </div>
                    </div>

                </div>
            </div><!-- panel-body -->
<!-- panel-footer -->


        </div><!-- panel -->

    </div><!-- panel-body -->

</div><!-- panel -->

</div><!-- contentpanel -->

@endsection


