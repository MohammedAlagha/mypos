        @if ($products->count() > 0)
        <table class="table table-hover">
            <tr>
                <th>@lang('site.name')</th>
                <th>@lang('site.quantity')</th>
                <th>@lang('site.price')</th>
            </tr>
            @foreach ($products as $product)
            <tr>
                <td>{{$product->name}}</td>
                <td>{{$product->pivot->quantity}}</td>
                <td>{{number_format($product->sale_price, 2)}}</td>

            </tr>
            @endforeach
        </table>
         <div>@lang('site.total') :<span class="total-price">{{number_format($order->total_price, 2)}}</span></div>
         <br>
         <button type="button" class="btn btn-primary" id="create-order-form-btn"><i class="glyphicon glyphicon-print"></i>  @lang('site.print')</button>

        @else
         @lang('site.no_records')
        @endif
