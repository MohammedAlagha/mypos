@extends('layouts.dashboard.app')

@section('content')

<div class="pageheader">
    <h2><i class="glyphicon glyphicon-user"></i> @lang('site.categories') <span>@lang('site.category_create')</span></h2>
    <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li class="active">@lang('site.dashboard')</li>
            <li class="active">@lang('site.categories')</li>
            <li class="active">@lang('site.category_create')</li>
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
            <h4 class="panel-title">@lang('site.category_create')</h4>

        </div>
        <div class="panel-body panel-body-nopadding">
            @include('partials._errors')
            {!! Form::open(['route'=>'dashboard.categories.store' ,'id'=>"category-create",'class'=>'form-horizontal','method'=>"post" ]) !!}
            <div class="panel panel-default">
                <div class="panel-body">
                    @foreach (config('translatable.locales') as $locale)
                        <div class="form-group">
                                <label class="col-sm-3 control-label">@lang('site.'.$locale.'.name') <span
                                        class="asterisk">*</span></label>
                                <div class="col-sm-6">
                                <input type="text" name='{{ $locale }}[name]' placeholder="" value="{{old($locale.'.name')}}" class="form-control" required />
                                </div>
                        </div>
                    @endforeach

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


<script>
    jQuery(document).ready(function(){
    console.log('d')
    "use strict";
    jQuery("#category-create").validate({
        highlight: function(element) {
        jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
        jQuery(element).closest('.form-group').removeClass('has-error');
        }
    });
});







</script>
@endpush
