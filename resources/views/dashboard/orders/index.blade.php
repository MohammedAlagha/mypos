@extends('layouts.dashboard.app')

@section('title',__('site.order_create'))

@push('head')
<link href="{{asset('dashboard_files/css/jquery.datatables.css')}}" rel="stylesheet">
<style>
    .loader {
    border: 16px solid #f3f3f3; /* Light grey */
    border-top: 16px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
    display: none;
    }

    @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
    }
</style>
@endpush

@section('content')

<div class="pageheader">
    <h2><i class="glyphicon glyphicon-user"></i> @lang('site.orders') <span>@lang('site.order_create')</span></h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.clients.create')}}">@lang('site.order_create')</a></li>
            {{-- <li><a href="{{route('dashboard.clients.index')}}">@lang('site.clients')</a></li> --}}
            <li class="active">@lang('site.dashboard')</li>
        </ol>
    </div>
</div>

    <div class="contentpanel">

        <div class="row">
            <div class="col-md-8">
                <div class="panel-heading">
                    <h5 class="panel-title">@lang('site.orders')</h5>
                </div>
                <div class="panel-footer">
                        <div class="table-responsive">
                                <table class="table" id="table1">
                                    <thead>
                                        <tr>
                                            <th>@lang('site.id')</th>
                                            <th>@lang('site.client_name')</th>
                                            <th>@lang('site.price')</th>
                                            <th>@lang('site.created_at')</th>
                                            <th>@lang('site.options')</th>
                                        </tr>
                                    </thead>
                                </table>
                        </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5 class="panel-title">@lang('site.products_show')</h5>
                        </div>
                        <div class="panel-footer" id="products-show">
                            <div style='text-align:center'>
                                <div class="loader"></div>
                            </div>


                        </div>



                                </div><!-- panel-footer -->
                </div><!-- panel -->
            </div>

        </div><!-- row -->

    </div><!-- contentpanel -->

    @endsection

    @push('script')


    <script src="{{asset('dashboard_files/js/jquery.datatables.min.js')}}"></script>
    <script src="{{asset('dashboard_files/js/select2.min.js')}}"></script>


    <script>
     jQuery(document).ready(function() {


            "use strict";

            var table = jQuery('#table1').DataTable({     //For making the table and I give it name to call it
                    serverSide: true,
                    processing: true,
                    ajax: {
                        "url": "{{route('dashboard.orders.data')}}",
                    },
                    columns: [
                        {data: 'id'},
                        {data: 'client_name'},
                        {data: 'total_price'},
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


         $(document).on('click','.order-products',function(e) {
            e.preventDefault();

            $('.loader').css('display','inline-block')  //for showing loader

            let url = $(this).data('url');
            let method = $(this).data('method');

            $.ajax({
                url:url,
                method:method,
                success:function(data){
                    
                    $('.loader').css('display','none')  //for hiding loader
                    $('#products-show').empty();
                    $('#products-show').append(data);
                }
            })
         })
    </script>

    @include('partials._session')

    @endpush
