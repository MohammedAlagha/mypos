        @if ($products->count() > 0)
        <div id="for-printing">
            <table class="table table-hover">
                <tr>
                    <th>@lang('site.product')</th>
                    <th>@lang('site.quantity')</th>
                    <th>@lang('site.unit_price')</th>
                    <th>@lang('site.price')</th>
                </tr>
                @foreach ($products as $product)
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
         <br>

         <button type="button" class="btn btn-primary" id="print-order"
          data-client_name="{{$order->client->name}}" data-order_number="{{$order->id}}" data-created_at="{{$order->created_at}}"    {{-- this data for printing--}}
         ><i class="glyphicon glyphicon-print"></i>  @lang('site.print')</button>

        @else
         @lang('site.no_records')
        @endif
