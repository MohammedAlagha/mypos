@extends('layouts.dashboard.app')

@section('content')

<div class="pageheader">
    <h2><i class="glyphicon glyphicon-user"></i> @lang('site.products') <span>@lang('site.product_create')</span></h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li><a href="index.html">@lang('site.product_create')</a></li>
            <li><a href="index.html">@lang('site.products')</a></li>
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
            <h4 class="panel-title">@lang('site.product_create')</h4>

        </div>
        <div class="panel-body panel-body-nopadding">
            @include('partials._errors')
            {!! Form::open(['route'=>'dashboard.products.store' ,'id'=>"products-create",'class'=>'form-horizontal', 'files'=>true,
            'method'=>"post" ]) !!}
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.category') <span
                                class="asterisk">*</span></label>
                        <div class="col-sm-6">
                        <select  name='category_id' placeholder=""  class="form-control" >
                            <option value="">@lang('site.category_select')</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" @if(old($category->id) == $category->id) {{'selected'}} @endif >{{$category->name}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>

                    @foreach (config('translatable.locales') as $locale)

                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.'.$locale.'.name')<span
                                class="asterisk">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" name='{{$locale}}[name]' placeholder="" value="{{old($locale.'.name')}}" class="form-control" required />
                        </div>
                    </div>

                    <div class="form-group">
                            <label class="col-sm-3 control-label">@lang('site.'.$locale.'.decription')</label>
                            <div class="col-sm-9">
                            <textarea name='{{$locale}}[description]' placeholder=""  class="form-control ckeditor"  >{!!old($locale.'.description')!!}</textarea>
                            </div>
                        </div>

                    @endforeach


                    <div class="form-group">
                            <label class="col-sm-3 control-label">@lang('site.image')</label>
                            <div class="col-sm-6">
                                <input type="file" name='image' placeholder="" class="form-control" id="image"  />
                             </div>
                    </div>

                    <div class="form-group offset-md-4">
                            <label class="col-sm-4 control-label"></label>
                            <div class="col-sm-6">
                                <img src="{{asset('uploads/product_images/default.png')}}" alt="" style="size:100px" class="img-thumbnail" id="image-preview">
                            </div>
                    </div>


                     <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.purchase_price')<span
                                class="asterisk">*</span></label>
                        <div class="col-sm-6">
                            <input type="number" name='purchase_price' step="0.01" placeholder="" value="{{old('purchase_price')}}" class="form-control" required />
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.sale_price')<span
                                class="asterisk">*</span></label>
                        <div class="col-sm-6">
                            <input type="number" name='sale_price' step="0.01" placeholder="" value="{{old('sale_price')}}" class="form-control" required />
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.stock')<span
                                class="asterisk">*</span></label>
                        <div class="col-sm-6">
                            <input type="number" name='stock' placeholder="" value="{{old('stock')}}" class="form-control" required />
                        </div>
                    </div>

                </div>
            </div><!-- panel-body -->
            <div class="panel-footer">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <button type="submit" class="btn btn-primary" id="store"><i class="fa fa-plus"></i>
                            @lang('site.add')</button>&nbsp;
                        <button class="btn btn-default">@lang('site.cancel')</button>
                    </div>
                </div>
            </div><!-- panel-footer -->
            {!! Form::close() !!}

        </div><!-- panel -->

    </div><!-- panel-body -->

</div><!-- panel -->

</div><!-- contentpanel -->

@endsection

@push('script')
    <script src="{{asset('dashboard/js/ckeditor/ckeditor.js')}}"></script>
@if (app()->getlocale() == 'ar')
    <script src="{{asset('dashboard/js/ckeditor/lang/ar.js')}}"></script>
@elseif(app()->getlocale() == 'en')
    <script src="{{asset('dashboard/js/ckeditor/lang/en.js')}}"></script>
@endif
<script>
    jQuery(document).ready(function(){
    "use strict";
    jQuery("#product-create").validate({
        highlight: function(element) {
        jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
        jQuery(element).closest('.form-group').removeClass('has-error');
        }
    });
});


jQuery('#image').change(function(){

  if (this.files && this.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        jQuery('#image-preview').attr('src', e.target.result);
    }

    reader.readAsDataURL(this.files[0]);
  }
});




</script>
@endpush
