@extends('layouts.dashboard.app')

@section('content')

<div class="pageheader">
    <h2><i class="glyphicon glyphicon-user"></i> @lang('site.users') <span>@lang('site.user_edit')</span></h2>
    <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.users.edit',[$user->id])}}">@lang('site.user_edit')</a></li>
            <li><a href="{{route('dashboard.users.index')}}">@lang('site.users')</a></li>
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
            <h4 class="panel-title">@lang('site.user_edit')</h4>

        </div>
        <div class="panel-body panel-body-nopadding">
            @include('partials._errors')
            {!! Form::open(['route'=>['dashboard.users.update',$user->id ],'id'=>"user-edit",'class'=>'form-horizontal','files'=>true,
            'method'=>"patch" ]) !!}

             <input type="hidden" name="id" value="{{$user->id}}">   {{-- hidden id for validation request only --}}
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.first_name') <span
                                class="asterisk">*</span></label>
                        <div class="col-sm-6">
                        <input type="text" name='first_name' placeholder="" class="form-control" value="{{$user->first_name}}" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.last_name')<span
                                class="asterisk">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" name='last_name' placeholder="" class="form-control" value="{{$user->last_name}}" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.email')<span class="asterisk">*</span></label>
                        <div class="col-sm-6">
                        <input type="email" name='email' placeholder="" class="form-control" value="{{$user->email}}" required />
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="col-sm-3 control-label">@lang('site.image')</label>
                            <div class="col-sm-6">
                                <input type="file" name='image' placeholder="" value="" class="form-control" id="image"  />
                    </div>

                    <div class="form-group ">
                            <label class="col-sm-4 control-label"></label>
                            <div class="col-sm-6">
                            <img src="{{$user->image_path}}" alt="" style="size:100px" class="img-thumbnail" id="image-preview">
                    </div>
                    {{-- <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.password')<span
                                class="asterisk">*</span></label>
                        <div class="col-sm-6">
                            <input type="password" name='password' placeholder="" class="form-control" value="" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.password_confirmation')<span
                                class="asterisk">*</span></label>
                        <div class="col-sm-6">
                            <input type="password" name='password_confirmation' placeholder="" value="" class="form-control"
                            value="" required />
                        </div>
                    </div> --}}
                    <div class="form-group">
                            <label class="col-sm-3 control-label">@lang('site.permissions')<span
                                    class="asterisk">*</span></label>
                            <div class="col-sm-6">
                                @php
                                    $models = ['users','categories','products','clients','orders'];

                                    $maps = ['create', 'read', 'update' ,'delete'];
                                @endphp
                                    <ul class="nav nav-tabs">
                                        @foreach ($models as $index=>$model)
                                            <li class="{{$index==0?'active':''}}"><a href="#{{$model}}" data-toggle="tab"><strong>@lang('site.'.$model)</strong></a></li>
                                        @endforeach

                                    </ul> <!-- end of tab content-->
                                        <!-- Tab panes -->
                                        <div class="tab-content mb30">
                                            @foreach ($models as $index=>$model)
                                            <div class="tab-pane {{$index == 0?'active':''}}" id="{{$model}}">
                                                @foreach ($maps as $map)
                                                    <div class="ckbox ckbox-primary">
                                                        <input type="checkbox" name="permissions[]" {{$user->can($map.'_'.$model)?'checked':''}} value="{{$map.'_'.$model}}" id="{{$map.'_'.$model}}" />
                                                        <label for="{{$map.'_'.$model}}">@lang('site.'.$map)</label>
                                                    </div>

                                                @endforeach
                                                    {{-- <div class="ckbox ckbox-primary">
                                                        <input type="checkbox" name="permissions[]" value="read_{{$model}}" id="read_{{$model}}" />
                                                        <label for="read_{{$model}}">@lang('site.show')</label>
                                                    </div>
                                                    <div class="ckbox ckbox-primary">
                                                        <input type="checkbox" name="permissions[]" value="update_{{$model}}" id="update_{{$model}}" />
                                                        <label for="update_{{$model}}">@lang('site.edit')</label>
                                                    </div>
                                                    <div class="ckbox ckbox-primary">
                                                        <input type="checkbox" name="permissions[]" value="delete_{{$model}}" id="delete_{{$model}}" />
                                                        <label for="delete_{{$model}}">@lang('site.delete')</label>
                                                    </div> --}}
                                                </div>
                                            @endforeach
                                        </div> <!--end of nav tabs-->


                            </div>
                        </div>
                    <!-- Nav tabs -->


                </div>
            </div><!-- panel-body -->
            <div class="panel-footer">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <button type="submit" class="btn btn-primary" id="store"><i class="fa fa-edit"></i>
                            @lang('site.update')</button>&nbsp;
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
        jQuery("#user-edit").validate({
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
