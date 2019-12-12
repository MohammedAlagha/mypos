@extends('layouts.dashboard.app')

@section('title',__('site.order_create'))


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
            <div class="col-md-6">
                <div class="panel-heading">
                    <h5 class="subtitle">@lang('site.categories')</h5>
                </div>

                <div class="panel-group" id="accordion">
                    @foreach ($categories as $category)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" class="collapsed" data-parent="#accordion"
                                    href="#{{str_replace(' ','-',$category->translate(app()->getlocale())->name)}}">
                                    {{$category->translate(app()->getlocale())->name}}
                                </a>
                            </h4>
                        </div>
                        <div id="{{str_replace(' ','-',$category->translate(app()->getlocale())->name)}}"
                            class="panel-collapse collapse">
                            <div class="panel-body">
                                @if ($category->products->count() > 0)
                                <table class="table table-hover">
                                    <tr>
                                        <th>@lang('site.name')</th>
                                        <th>@lang('site.stock')</th>
                                        <th>@lang('site.price')</th>
                                        <th>@lang('site.add')</th>
                                    </tr>
                                    @foreach ($category->products as $product)
                                    <tr>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->stock}}</td>
                                        <td>{{$product->sale_price}}</td>
                                        <td>
                                            <a href="" id="product-{{$product->id}}" data-name="{{$product->name}}"
                                                data-id="{{$product->id}}" data-price="{{$product->sale_price}}"
                                                class="btn btn-success btn-sm add-product-btn">
                                                <i class="fa fa-plus"></i>

                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                                @else
                                 @lang('site.no_records')
                                @endif
                             </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>

            <div class="col-sm-6">
                <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5 class="subtitle">@lang('site.orders')</h5>
                        </div>
                    <div class="panel-footer">
                            <table class="table table-hover mb30">
                                    <thead>
                                      <tr>
                                        <th>@lang('site.product')</th>
                                        <th>@lang('site.quantity')</th>
                                        <th>@lang('site.price')</th>
                                      </tr>
                                    </thead>
                                    <tbody class="order-list">
                                      {{-- <tr>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                      </tr> --}}
                                    </tbody>
                                  </table>
                                  <div>@lang('site.total') :<span class="total-price"></span></div>
                                  <br>
                                  <button class="btn btn-primary">@lang('site.order_create')</button>
                    </div><!-- panel-footer -->
                </div><!-- panel -->
            </div>

        </div><!-- row -->

    </div><!-- contentpanel -->

    @endsection

    @push('script')

    <script>
        $(document).ready(function(){
            $('.add-product-btn').on('click',function(e) {
                e.preventDefault();
                $(this).removeClass('btn-success').addClass('btn-default disabled');
                let name = $(this).data('name');
                let id = $(this).data('id');
                let price = $.number($(this).data('price'),2);

                let html =
                `<tr>
                    <td>${name}</td>
                    <td><input type='number' name='quanities[]' data-price=${price} value='1' min='1' class='form-control input-sm product-quentity'></td>
                    <td class='product-price'>${price}</td>
                    <td><button class='btn btn-danger btn-sm remove-product-btn' data-id=${id}><i class='glyphicon glyphicon-trash'></i></button></td>
                </tr>`

                $('.order-list').append(html);

                //to calculate total price
                calculateTotal();

            })

            $('body').on('click','.disabled',function(e) {    //I belive not nesssary
                e.preventDefault();
            })

            $('body').on('click','.remove-product-btn',function (e) {
                    e.preventDefault();

                let id = $(this).data('id');

                $(this).closest('tr').remove();
                $('#product-' + id).removeClass('btn-default disabled').addClass('btn-success');

                //to calculate total price
                calculateTotal();

            }) //end of remove-product-btn

            $('body').on('change','.product-quentity', function () {

                let quantity = $(this).val();
                let unitPrice = $(this).data('price');
                $(this).closest('tr').find('.product-price').html($.number(quantity * unitPrice ,2));
                calculateTotal();

            })

        });

        function calculateTotal() {
            let price =0;
            $('.order-list .product-price').each(function (index){
                price += parseFloat($(this).html().replace(/,/g,''));

            });
            $('.total-price').html($.number(price ,2))
        }


    </script>
    @endpush
