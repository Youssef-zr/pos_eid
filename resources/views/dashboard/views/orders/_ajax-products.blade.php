<div id="order-products-printing">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{ trans('lang.product') }}</th>
                <th>{{ trans('lang.price') }}</th>
                <th>{{ trans('lang.stock') }}</th>
                <th>{{ trans('lang.total') }}</th>
            </tr>
        </thead>
        <tbody>
            <!-- order products list -->
            @foreach ($order->products as $product)
                <tr>
                    <td>
                        <div class="product-image">
                            <div class="thumbnail text-center">
                                <img src="{{ url($product->photo) }}" class="img-thumbnail">
                            </div>
                            <div class="full-width">
                                <span class="close-image close btn btn-danger btn-sm">
                                    <i class="fa fa-times"></i>
                                </span>
                                <img src="{{ url($product->photo) }}" class="img-thumbnail">
                            </div>
                        </div>
                    </td>

                    <td>{{ $product->sale_price }}$</td>
                    <td>{{ $product->pivot->quantity }}</td>
                    <td>{{ $product->pivot->quantity * $product->sale_price }}$</td>
                </tr>
            @endforeach

            <!-- total price of orders -->
            <tr class="bg-secondary">
                <td colspan="3">{{ trans('lang.total_price') }}</td>
                <td>{{ $order->total_price }}$</td>
            </tr>
        </tbody>
    </table>
</div>

<!-- print table order products -->
<div class="print-order-poroducts">
    <button id="print-order" class="btn btn-primary btn-sm btn-block">
        <i class="fa fa-print"></i>
        {{ trans('lang.print') }}
    </button>
</div>
