@extends('dashboard.layouts.master')

@section('braidcrump')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fa fa-shopping-bag"></i> {{ trans('lang.orders_new') }} </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ adminurl('clients') }}"><i class="fa fa-list"></i>
                                {{ trans('lang.clients_list') }}</a></li>
                        <li class="breadcrumb-item active"><i class="fa fa-plus-circle"></i> {{ trans('lang.orders_new') }}
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('content')
    <div class="box text-capitalize">
        <div class="box-body">

            {{-- categories products section --}}
            <div class="card card-primary card-outline mg-b-20">
                <div class="card-header">
                    <h4 class="title"><i class="fa fa-tags"></i> {{ trans('lang.categories') }} </h4>
                </div>
                <div class="card-body">
                    <div class="categories-products">
                        <div class="category-products">
                            <div class="card card-primary card-tabs">
                                <div class="card-header p-0 pt-1">
                                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                        @foreach ($categories as $category)
                                            <li class="nav-item">
                                                <a class="nav-link {{ $category->id == 1 ? 'active' : '' }}"
                                                    id="category-{{ $category->id }}" data-toggle="pill"
                                                    href="#category-tab-{{ $category->id }}" role="tab"
                                                    aria-controls="category-tab-{{ $category->id }}"
                                                    aria-selected="true">{{ $category->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-one-tabContent">
                                        @foreach ($categories as $category)
                                            <div class="tab-pane fade {{ $category->id == 1 ? 'show active' : '' }}"
                                                id="category-tab-{{ $category->id }}" role="tabpanel"
                                                aria-labelledby="category-{{ $category->id }}">

                                                {{-- start table content --}}
                                                <table class="table table-hovered table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>@lang('lang.name')</th>
                                                            <th>@lang('lang.stock')</th>
                                                            <th>@lang('lang.price')</th>
                                                            <th>@lang('lang.add')</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($category->products as $product)
                                                            <tr>
                                                                <td>{{ $product->title }}</td>
                                                                <td>{{ $product->stock }}</td>
                                                                <td>{{ $product->sale_price }}$</td>
                                                                <td>
                                                                    <button id="product-{{ $product->id }}"
                                                                        data-id="{{ $product->id }}"
                                                                        data-name="{{ $product->title }}"
                                                                        data-price="{{ $product->sale_price }}"
                                                                        class="btn btn-success btn-sm btn_add_product">
                                                                        <i class="fa fa-plus-circle"></i>
                                                                        @lang('lang.add')
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                {{-- end table content --}}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            {{-- orders list --}}
            <div class="card card-primary card-outline mg-b-20">
                <div class="card-header">
                    <h4 class="title"><i class="fa fa-shopping-bag"></i> {{ trans('lang.orders') }} </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            {{-- show errors --}}
                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            {{-- form fields new client order --}}
                            {!! Form::open(['route' => ['dashboard.client.orders.store', $client->id], 'method' => 'post']) !!}
                            @method('post')
                            <table class="table table-hovered table-striped">
                                <thead>
                                    <tr>
                                        <th>@lang('lang.product')</th>
                                        <th>@lang('lang.stock')</th>
                                        <th>@lang('lang.price')</th>
                                        <th>@lang('lang.total')</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="order-list">

                                </tbody>
                            </table>
                            <div class="total-price mt-4 mb-1">
                                <p>@lang('lang.total'): <span id="total-price">0</span></p>
                            </div>
                            <div class="add-order">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus-circle"></i>
                                    @lang('lang.add_order')
                                </button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container closed -->
    </div>
@endsection

@push('css')
    <style>
        table tbody tr td {
            padding: 5px 0 !important;
        }
    </style>
@endpush

@push('js')
    {{-- jquery number --}}
    <script src="{{ url('assets/dashboard/plugins/jquery-number/jquery.number.min.js') }}"></script>

    <script>
        $(() => {
            const btn_add_product = $('.btn_add_product');

            // add product order btn
            btn_add_product.on("click", function() {

                $(this).addClass('disabled').attr('disabled', true)

                let id = $(this).data('id');
                let name = $(this).data('name');
                let price = $(this).data('price');

                const html = `<tr>
                    <td>
                        ${name}
                    </td>
                    <td class="product-qty">
                        <input type="number" name="products[${id}][quantity]"
                            value="1" min="1" class="form-control product-quantities">
                    </td>
                    <td class="product-price" data-price="${price}">
                        ${$.number(price,2,".")+"$"}
                    </td>
                    <td class="product-total-price" data-total="${price}">${price+"$"}</td>
                    <td>
                        <button class="btn btn-danger btn-sm remove-product" data-id="${id}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>`;

                let orderTable = $(".order-list");
                orderTable.append(html);

                // calculate total price of products ordered
                calculate_total_price()
            })

            // remove product from orders list table
            $('body').on('click', ".remove-product", function() {

                // enabled button add product
                let id = $(this).data('id');
                $('#product-' + id).removeClass('disabled').attr('disabled', false)

                // remove item
                $(this).parentsUntil("tbody").remove();

                // calculate total price of products ordered
                calculate_total_price()
            });

            // change qty of products and calculate total price again
            $('body').on('change', '.product-quantities', function() {
                calculate_total_price()
            })

            // claculate total price
            const calculate_total_price = () => {

                let total_price = 0;
                let products_price = new Set($('body .product-price'));

                products_price.forEach(element => {
                    const $element = $(element);
                    let unit_qty = $element.siblings("td.product-qty").find('input').val();

                    let unit_price = Number($element.data('price') * unit_qty);

                    let unitElPrice = $element.siblings('td.product-total-price');
                    unitElPrice.data('total', unit_price)
                        .html($.number(unit_price, 2, '.') + "$")

                    total_price += unit_price;
                });

                $('#total-price').html($.number(total_price, 2, ".") + "$");

                // check if the total price greather than 0
                let orderBtn = $('.add-order button');
                if (total_price > 0) {
                    orderBtn.removeClass('disabled').attr('disabled', false);
                } else {
                    orderBtn.addClass('disabled').attr('disabled', true);
                }
            }
        })
    </script>
@endpush
