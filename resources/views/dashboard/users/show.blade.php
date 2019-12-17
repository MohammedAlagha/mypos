@extends('layouts.dashboard.app')
@section('title',__('site.user_show'))

@section('content')

<div class="pageheader">
    <h2><i class="glyphicon glyphicon-user"></i> @lang('site.users') <span>@lang('site.user_show')</span></h2>
    <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.users.show',[$user->id])}}">@lang('site.user_show')</a></li>
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

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.first_name') <span
                                class="asterisk">*</span></label>
                        <div class="col-sm-6">
                        <input type="text" name='first_name' placeholder="" class="form-control" value="{{$user->first_name}}" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.last_name')<span
                                class="asterisk">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" name='last_name' placeholder="" class="form-control" value="{{$user->last_name}}" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.email')<span class="asterisk">*</span></label>
                        <div class="col-sm-6">
                        <input type="email" name='email' placeholder="" class="form-control" value="{{$user->email}}" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="col-sm-3 control-label">@lang('site.image')</label>
                           
                    </div>

                    <div class="form-group ">
                            <label class="col-sm-4 control-label"></label>
                            <div class="col-sm-6">
                                <img src="{{$user->image_path}}" alt="" style="size:100px" class="img-thumbnail" id="image-preview">
                            </div>
                    </div>


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
                                                        <input disabled type="checkbox" name="permissions[]" {{$user->can($map.'_'.$model)?'checked':''}} value="{{$map.'_'.$model}}" id="{{$map.'_'.$model}}" />
                                                        <label for="{{$map.'_'.$model}}">@lang('site.'.$map)</label>
                                                    </div>

                                                @endforeach
                                                </div>
                                            @endforeach
                                        </div> <!--end of nav tabs-->


                            </div>
                        </div>
                    <!-- Nav tabs -->


                </div>
            </div><!-- panel-body -->


        </div><!-- panel -->

    </div><!-- panel-body -->

</div><!-- panel -->

</div><!-- contentpanel -->

@endsection

@push('script')


<script>



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
