@extends('layouts.dashboard.app')

@section('content')

<div class="pageheader">
    <h2><i class="glyphicon glyphicon-user"></i> @lang('site.users') <span>@lang('site.user_create')</span></h2>
    <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li><a href="index.html">Bracket</a></li>
            <li class="active">Dashboard</li>
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
            <h4 class="panel-title">انشاء مشرف</h4>

        </div>
        <div class="panel-body panel-body-nopadding">
            @include('partials._errors')
                {!! Form::open(['route'=>'dashboard.users.store' ,'id'=>"user-create",'class'=>'form-horizontal' , 'method'=>"post" ]) !!}
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">@lang('site.first_name') <span
                                    class="asterisk">*</span></label>
                            <div class="col-sm-6">
                                <input type="text" name='first_name' placeholder="" class="form-control" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">@lang('site.last_name')<span
                                    class="asterisk">*</span></label>
                            <div class="col-sm-6">
                                <input type="text" name='last_name' placeholder="" class="form-control" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">@lang('site.email')<span
                                    class="asterisk">*</span></label>
                            <div class="col-sm-6">
                                <input type="email" name='email' placeholder="" class="form-control" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">@lang('site.password')<span
                                    class="asterisk">*</span></label>
                            <div class="col-sm-6">
                                <input type="password" name='password' placeholder="" class="form-control" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">@lang('site.password_confirmation')<span
                                    class="asterisk">*</span></label>
                            <div class="col-sm-6">
                                <input type="password" name='password_confirmation' placeholder="" class="form-control"
                                    required />
                            </div>
                        </div>
                    </div>
                </div><!-- panel-body -->
                <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>&nbsp;
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
<script src="{{asset('dashboard/js/jquery.validate.min.js')}}"></script>

<script>
    jQuery(document).ready(function(){
    console.log('d')
    "use strict";
    jQuery("#user-create").validate({
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
