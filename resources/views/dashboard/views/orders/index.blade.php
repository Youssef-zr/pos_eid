@extends('dashboard.layouts.master')

@section('braidcrump')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fa fa-dashboard"></i> {{ trans('lang.dashboard') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item d-flex align-items-center">
                            <i class="fa fa-dashboard mx-1"></i>
                            {{ trans('lang.dashboard') }}
                        </li>
                        <li class="breadcrumb-item active"><i class="fa fa-shopping-bag"></i> {{ $title }}
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('content')
    <div class="row">
        <!-- start orders list -->
        <div class="col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h4 class="title"><i class="fa fa-shopping-bag"></i> {{ $title }} </h4>
                </div>
                <div class="card-body">
                    <!-- actions-->
                    <div class="actions d-flex">
                        <!-- more actions -->
                        <div class="btn-group" id="more-actions">
                            <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-cogs"></i>
                                {{ trans('lang.actions') }}</button>
                            <button type="button" class="btn btn-warning btn-sm dropdown-toggle dropdown-icon"
                                data-toggle="dropdown">
                                <span class="sr-only">Toggle
                                    Dropdown
                                </span>
                            </button>
                            <div class="dropdown-menu" role="menu" id="global-actions">
                                <label class="dropdown-item mb-0" id="btn-pdf"></label>
                                <label class="dropdown-item mb-0" id="btn-excel"></label>
                            </div>
                        </div>
                    </div>

                    <!-- Main content -->
                    <section class="content">
                        <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <table id="example" class="stripe row-border order-column text-capitalize w-100">
                                <thead>
                                    <tr>
                                        <th>{{ trans('lang.client_name') }}</th>
                                        <th>{{ trans('lang.price') }}</th>
                                        <th>{{ trans('lang.created_at') }}</th>
                                        <th>{{ trans('lang.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->client->name }}</td>
                                            <td>{{ $order->total_price }}$</td>
                                            <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                            <td>
                                                @permission('read_orders')
                                                    <button class="btn btn-primary btn-sm show-order-products"
                                                        data-url='{{ route('dashboard.order.products', $order->id) }}'>
                                                        <i class="fa fa-eye"></i>
                                                        {{ trans('lang.show') }}
                                                    </button>
                                                @endpermission

                                                @permission('update_orders')
                                                    <a href="{{ route('dashboard.client.orders.edit', [$order->client->id, $order->id]) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fa fa-pencil"></i>
                                                        {{ trans('lang.update') }}
                                                    </a>
                                                @endpermission

                                                @permission('delete_orders')
                                                    <a href="" class="btn btn-danger btn-sm delete-modal"
                                                        data-modal="deleteOrder" data-id="{{ $order->id }}">
                                                        <i class="fa fa-trash"></i>
                                                        {{ trans('lang.delete') }}
                                                    </a>
                                                @endpermission
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Modal Remove category-->
                        @permission('delete_orders')
                            <div class="modal text-left" id="deleteOrder" style="overflow: hidden">
                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">{{ trans('lang.remove_modal_header') }}</h4>
                                                <button type="button" class="close hide-modal" data-modal="deleteOrder"><i
                                                        class="fa fa-times-circle"></i></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <h3 class="mb2 text-center" style="color:#f39c12"><i
                                                        class="fa fa-exclamation-triangle fa-3x"></i>
                                                </h3>
                                                <p class="text-center">
                                                    {{ trans('lang.remove_modal_body') }}
                                                </p>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer" style="text-align: center !important">
                                                <form action="" data-url="{{ adminUrl('orders') }}" method="post"
                                                    style="display: none" id="form-delete">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                                <button type="button" class="btn btn-success confirm-delete btn-sm">
                                                    <i class="fa fa-send"></i>
                                                    {{ trans('lang.confirm') }}
                                                </button>
                                                <button type="button" class="btn btn-danger bg-maroon hide-modal btn-sm"
                                                    data-modal="deleteOrder">
                                                    <i class="fa fa-times"></i>
                                                    {{ trans('lang.cancel') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endpermission
                        <!-- /.card -->
                    </section>
                    <!-- /.content -->
                </div>
            </div>
        </div>
        <!-- end orders list -->

        <!-- start order products ajax list -->
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h4 class="title"><i class="fa fa-tags"></i> {{ trans('lang.products') }} </h4>
                </div>
                <div class="card-body">
                    <div class="loading">
                        <i class="fa fa-refresh fa-spin fa-3x text-primary"></i>
                    </div>
                    <div id="order-products-list">
                        <p class="alert alert-warning"> {{ trans('lang.empty_product_list') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end order products ajax list -->
    </div>
@endsection

@push('css')
    {{-- datatables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" />

    <style>
        table tbody tr td {
            padding: 10px 0 !important
        }

        .product-image {
            position: relative;
        }

        .product-image .thumbnail {
            margin: auto;
            width: 70px;
            height: 50px;
        }

        .product-image .thumbnail img {
            width: 100%;
            height: 95%
        }

        .product-image .full-width {
            position: absolute;
            width: 200px;
            top: -26px;
            z-index: 10;
            display: none
        }

        .product-image .full-width .close-image {
            position: absolute;
            top: 1px;
            right: 2px;
            color: red;
            cursor: pointer;
        }

        .card-body {
            position: relative;
        }

        .loading {
            display: none;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            background: #fff;
            position: absolute;
            left: 0;
            top: 0;
            z-index: 99
        }
    </style>
@endpush

@push('js')
    {{-- datatybles --}}
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/b-2.1.1/b-html5-2.1.1/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.15/sorting/numeric-comma.js"></script>

    {{-- print this  --}}
    <script src="{{ url('assets/dashboard/plugins/print-this/printThis.js') }}"></script>

    <script>
        $(() => {
            $table = $('#example').DataTable({
                direction: $dir,
                "order": [
                    [0, 'desc']
                ],
                "aLengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "{{ trans('lang.all') }}"]
                ],
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/" + $currentLang + ".json"
                },
                "columnDefs": [{
                    "width": "270px",
                    "targets": $('table').find('thead th').length - 1
                }, ],
                "buttons": [{
                        extend: 'excelHtml5',
                        className: "btn-success btn-sm btn-block",
                        charset: 'UTF-8',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        className: "btn-warning btn-sm btn-block",
                        charset: 'UTF-8',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5]
                        }
                    },
                ],
            });

            // change style of buttons excel and pdf
            setTimeout(() => {
                $table.buttons().container().insertBefore('#example_filter');
                $('.buttons-excel').html('<i class="fa fa-file-excel-o"></i> {{ trans('lang.dt_excel') }}')
                    .appendTo("#btn-pdf");

                $('.buttons-pdf').html('<i class="fa fa-file-pdf-o"></i> {{ trans('lang.dt_pdf') }}')
                    .appendTo("#btn-excel");

                // move actions btns to filter container
                $('.actions').appendTo(".dt-buttons");
            }, 500);

            // img thumbnail full width
            $("body").on('click', '.thumbnail', function() {
                $(this).siblings('.full-width').slideToggle(500)
            });

            $("body").on("click", '.close-image', function() {
                $(this).parent().slideUp(500);
            })

            // show order products
            $('.show-order-products').on('click', function() {
                // show loading
                const loading = $('.loading');
                loading.css('display', "flex");

                const url = $(this).data('url');
                const method = "get";

                // get order products from blade file _ajax-products
                $.ajax({
                    url,
                    method,
                    success($data) {
                        // hide loading
                        loading.fadeOut(500);

                        // append order products to list
                        $('#order-products-list').html($data);
                    }
                });
            });

            // print order products list
            $('body').on('click', "#print-order", function() {
                $('#order-products-printing').printThis({
                    importCSS: true,
                    header: `<h1 style="text-align:center">{{ trans('lang.invoice') }}</h1>`
                });
            })

        })
    </script>
@endpush
