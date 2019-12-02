@extends('layouts.dashboard.app')

@push('head')
<link href="{{asset('dashboard/css/jquery.datatables.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="pageheader">
    <h2><i class="glyphicon glyphicon-user"></i> @lang('site.products') <span>@lang('site.user_create')</span></h2>
    <div class="breadcrumb-wrapper">

        <ol class="breadcrumb">
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
            </div><!-- panel-btns -->
            <h3 class="panel-title">@lang('site.products')</h3>
            <p></p>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table" id="table1">
                    @if (auth()->user()->can('create_products'))
                        <a href="{{route('dashboard.products.create')}}" class="btn btn-primary pull-right"
                        style="margin: 0 0 22px 22px"><i class="fa fa-plus"></i> @lang('site.add')</a>
                    @else
                        <a class="btn btn-primary pull-right" style="margin: 0 0 22px 22px"><i class=" fa fa-plus"></i> @lang('site.add')</a>
                    @endif

                    <thead>
                        <tr>
                            <th>@lang('site.id')</th>
                            <th>@lang('site.name')</th>
                            <th>@lang('site.category')</th>
                            <th>@lang('site.purchase_price')</th>
                            <th>@lang('site.sale_price')</th>
                            <th>@lang('site.profit_percent')%</th>
                            <th>@lang('site.stock')</th>
                            <th>@lang('site.updated_at')</th>
                            <th>@lang('site.created_at')</th>
                            <th style="width:13%">@lang('site.options')</th>
                        </tr>
                    </thead>
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

              var table = jQuery('#table1').DataTable({     //For making the table and I give it name to call it
                        serverSide: true,
                        processing: true,
                        ajax: {
                            "url": "{{route('dashboard.products.data')}}",
                        },
                        columns: [
                            {data: 'id'},
                            {data: 'name'},
                            {data: 'category'},
                            {data: 'purchase_price'},
                            {data: 'sale_price'},
                            {data: 'profit_percent'},
                            {data: 'stock'},
                            {data: 'updated_at'},
                            {data: 'created_at'},
                            {data: 'action', orderable: false, searchable: false},

                         ]
                        });


              // Select2
              jQuery('select').select2({
                  minimumResultsForSearch: -1
              });

              jQuery('select').removeClass('form-control');

            });

            $(document).on('click','.delete' ,function (event) {
            event.preventDefault();
            var url = $(this).data('url');
            Swal.fire({
                title: '{{__('site.are_you_sure')}}',
                text: "",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{__('site.yes')}}',
                cancelButtonText: '{{__('site.cancel')}}',
                preConfirm: function () {
                    return new Promise(function (resolve, reject) {
                        $.ajax({
                            url: url,
                            type: 'Delete',
                            data:{_token: '{{ csrf_token() }}'},
                            dataType: 'json',
                            success: function (response) {
                                if(response.status == true){
                                    Swal.fire({
                                            text: response.message,
                                            timer: 2000,
                                            icon:"success",
                                            showCancelButton: false,
                                            showConfirmButton: false
                                        });
                                        jQuery('#table1').DataTable().ajax.reload(null, false);  //I need to pass parameters for keeping current page like
                                }else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: response.message,

                                    })
                                }

                            },
                            error: function (response) {
                                console.log(response)

                            }
                        });
                    });
                },
                allowOutsideClick: false
            }).then(function () {});
        });

</script>

@include('partials._session')

@endpush
