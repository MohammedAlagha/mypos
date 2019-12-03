@extends('layouts.dashboard.app')

@section('content')

<div class="pageheader">
<h2><i class="glyphicon glyphicon-user"></i> @lang('site.clients') <span>@lang('site.client_edit') {{$client->name}}</span></h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.clients.edit',[$client->id])}}">@lang('site.client_edit') {{$client->name}}</a></li>
            <li><a href="{{route('dashboard.clients.index')}}">@lang('site.clients')</a></li>
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
            <h4 class="panel-title">@lang('site.client_edit')</h4>

        </div>
        <div class="panel-body panel-body-nopadding">
            @include('partials._errors')
            {!! Form::open(['route'=>['dashboard.clients.update',$client->id] ,'id'=>"client-edit",'class'=>'form-horizontal','method'=>"PATCH" ]) !!}
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <input type="hidden" name="id" value="{{$client->id}}">
                        <label class="col-sm-3 control-label">@lang('site.name')<span
                                class="asterisk">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" name='name' placeholder="" value="{{$client->name}}" class="form-control" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.mobile')<span
                                class="asterisk">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" name='mobile' placeholder="" value="{{$client->mobile}}" class="form-control" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.phone')</label>
                        <div class="col-sm-6">
                            <input type="text" name='phone' placeholder="" value="{{$client->phone}}" class="form-control"  />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.address')</label>
                        <div class="col-sm-6">
                        <textarea name='address' placeholder="" class="form-control" >{!!$client->address!!}</textarea>
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


<script>

    jQuery(document).ready(function(){
        "use strict";
        jQuery("#client-edit").validate({
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
