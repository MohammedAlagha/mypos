@extends('layouts.dashboard.app')

@section('title',__('site.order_edit'))


@section('content')

<div class="pageheader">
    <h2><i class="glyphicon glyphicon-user"></i> @lang('site.orders') <span>@lang('site.order_edit')</span></h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.clients.orders.edit',[$order->client_id ,$order->id])}}">@lang('site.order_edit')</a></li>
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
                                        <td>{{number_format($product->sale_price, 2)}}</td>
                                        <td>
                                            <a href="" id="product-{{$product->id}}" data-name="{{$product->name}}"
                                                data-id="{{$product->id}}" data-price="{{$product->sale_price}}" data-stock="{{$product->stock}}"
                                                class=" btn {{in_array($product->id ,$order->products->pluck('id')->toArray())?'btn-default disabled':'btn-success'}} btn-sm add-product-btn ">
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
                        {!! Form::open(['route'=>['dashboard.clients.orders.update',$client->id,$order->id],'class'=>'form-horizonta','id'=>'order-edit','method'=>"PATCH"]) !!}
                            <table class="table table-hover mb30">
                                    @include('partials._errors')
                                    <thead>
                                      <tr>
                                        <th>@lang('site.product')</th>
                                        <th>@lang('site.quantity')</th>
                                        <th>@lang('site.price')</th>
                                      </tr>
                                    </thead>
                                    <tbody class="order-list">
                                      @foreach ($order->products as $product)
                                      <tr>
                                            <td>{{$product->name}}</td>
                                            <td><input type='number' name='products[{{$product->id}}][quantity]' value='{{$product->pivot->quantity}}' min='1' max='{{$product->stock}}' data-price="{{number_format($product->sale_price,2)}}" class='form-control input-sm product-quantity'></td>
                                            <td class='product-price' >{{number_format($product->sale_price * $product->pivot->quantity,2)}}</td>
                                            <td><button class='btn btn-danger btn-sm remove-product-btn'  data-id={{$product->id}}><i class='glyphicon glyphicon-trash'></i></button></td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                  </table>
                                    <div>@lang('site.total') :<span class="total-price">{{number_format($order->total_price,2)}}</span></div>
                                  <br>
                                  <button type="submit" class="btn btn-primary" id="edit-order-form-btn">@lang('site.order_edit')</button>
                                  {!! Form::close() !!}
                    </div><!-- panel-footer -->
                </div><!-- panel -->
            </div>

        </div><!-- row -->
        <div class="row">
                @if ($client->orders->count() > 0)
            <div class=" col-md-offset-6  col-sm-6">
                    <div class="panel-heading">
                    <h5 class="subtitle">@lang('site.previous_orders')<small> {{$client->orders->count()}}</small></h5>
                        </div>

                        <div class="panel-group" id="accordion">


                            @foreach ($orders as $order)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" class="collapsed" data-parent="#accordion"
                                            href="#{{$order->id}}">
                                            {{$order->created_at->toFormattedDateString()}}
                                        </a>
                                    </h4>
                                </div>
                                <div id="{{$order->id}}"
                                    class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <table class="table table-hover">
                                            <tr>
                                                <th>@lang('site.product')</th>
                                                <th>@lang('site.quantity')</th>
                                                <th>@lang('site.unit_price')</th>
                                                <th>@lang('site.price')</th>
                                            </tr>
                                            @foreach ($order->products as $product)
                                            <tr>
                                                <td>{{$product->name}}</td>
                                                <td>{{$product->pivot->quantity}}</td>
                                                <td>{{number_format($product->sale_price, 2)}}</td>
                                                <td>{{number_format($product->sale_price * $product->pivot->quantity, 2)}}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                        <div>@lang('site.total') :<span class="total-price">{{number_format($order->total_price, 2)}}</span></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            {{$orders->links()}}
                        </div>
            </div>
            @endif
        </div>

    </div><!-- contentpanel -->

    @endsection

    @push('script')

    <script>
        $(document).ready(function(){
            $('.add-product-btn').on('click',function(e) {
                e.preventDefault();
                $(this).removeClass('btn-success').addClass('btn-default disabled');
                let name = $(this).data('name');
                let stock = $(this).data('stock');
                let id = $(this).data('id');
                let price = $.number($(this).data('price'),2);
                // <input type='hidden' name='products[]' value=${id}></input>

                let html =
                `<tr>
                    <td>${name}</td>
                    <td><input type='number' name='products[${id}][quantity]' data-price=${price} value='1' min='1' max='${stock}' class='form-control input-sm product-quantity'></td>
                    <td class='product-price'>${price}</td>
                    <td><button class='btn btn-danger btn-sm remove-product-btn' data-id=${id}><i class='glyphicon glyphicon-trash'></i></button></td>
                </tr>`

                $('.order-list').append(html);

                //to calculate total price
                calculateTotal();

            })

            $('body').on('click','.disabled',function(e) {
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

            $('body').on('keyup change','.product-quantity', function () {
                console.log('ss')
                console.log($(this).data('price'))
                let quantity = $(this).val(); //2

                let unitPrice = parseFloat($(this).data('price').replace(/,/g,'')); //150

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

            if (price > 0) {
            $('#edit-order-form-btn').removeClass('disabled')

            }else{
                $('#edit-order-form-btn').addClass('disabled')
            }
        }



    </script>
    @endpush
