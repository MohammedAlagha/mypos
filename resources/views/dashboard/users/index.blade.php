@extends('layouts.dashboard.app')

@push('head')
<link href="{{asset('dashboard/css/jquery.datatables.css')}}" rel="stylesheet">
@endpush

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
            </div><!-- panel-btns -->
            <h3 class="panel-title">@lang('site.users')</h3>
            <p></p>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table" id="table1">
                    @if (auth()->user()->can('create-user'))
                        <a href="{{route('dashboard.users.create')}}" class="btn btn-primary pull-right"
                        style="margin: 0 0 22px 22px"><i class="fa fa-plus"></i> @lang('site.add')</a>
                    @else
                        <a class="btn btn-primary pull-right"
                        style="margin: 0 0 22px 22px"><i class=" fa fa-plus"></i> @lang('site.add')</a>
                    @endif

                    <thead>
                        <tr>
                            <th>id</th>
                            <th>@lang('site.first_name')</th>
                            <th>@lang('site.last_name')</th>
                            <th>@lang('site.email')</th>
                            <th>@lang('site.updated_at')</th>
                            <th>@lang('site.created_at')</th>
                            <th style="width:10%">@lang('site.options')</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="odd gradeX">
                            <td>Trident</td>
                            <td>Internet
                                Explorer 4.0</td>
                            <td>Win 95+</td>
                            <td class="center"> 4</td>
                            <td class="center">X</td>
                        </tr>
                        <tr class="even gradeC">
                            <td>Trident</td>
                            <td>Internet
                                Explorer 5.0</td>
                            <td>Win 95+</td>
                            <td class="center">5</td>
                            <td class="center">C</td>
                        </tr>


                    </tbody>
                </table>
            </div><!-- table-responsive -->


        </div><!-- panel-body -->
    </div><!-- panel -->


</div>



@endsection

@push('script')

<script src="{{asset('dashboard/js/jquery.datatables.min.js')}}"></script>
<script src="{{asset('dashboard/js/select2.min.js')}}"></script>

<script>
    jQuery(document).ready(function() {


              "use strict";

              jQuery('#table1').dataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    "url": "{{route('dashboard.users.data')}}",
                },
                columns: [
                    {data: 'id'},
                    {data: 'first_name'},
                    {data: 'last_name'},
                    {data: 'email'},
                    {data: 'updated_at'},
                    {data: 'created_at'},
                    {data: 'action'},
                    // {data: 'action', orderable: false, searchable: false}
                ]
              });


              // Select2
              jQuery('select').select2({
                  minimumResultsForSearch: -1
              });

              jQuery('select').removeClass('form-control');

              // Delete row in a table


              // Show aciton upon row hover

            });

</script>

@include('partials._session')

@endpush
