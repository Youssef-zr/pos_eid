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
                        <li class="breadcrumb-item align-items-center"><i class="fa fa-dashboard mx-1"></i>
                            {{ trans('lang.dashboard') }}</li>
                        <li class="breadcrumb-item active"><i class="fa fa-line-chart"></i> {{ trans('lang.stats') }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- container-fluid -->
    </section>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- card -->
        <div class="card bg-gradient-navy">
            <div class="card-header border-white">
                <h3 class="card-title float-left">
                    <div class="fa fa-line-chart"></div>
                    {{ trans('lang.site-stats') }}
                </h3>
            </div>
            <div class="card-body">
                <!-- start row stats -->
                <div class="row">
                    <!-- products -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $products_cout }}</h3>

                                <p>{{ trans('lang.products') }}</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-product-hunt"></i>
                            </div>
                            <a href="{{ adminUrl('products') }}" class="small-box-footer">
                                {{ trans('lang.more_info') }}
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- categories -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $categoris_count }}</h3>

                                <p>{{ trans('lang.categories') }}</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-tags"></i>
                            </div>
                            <a href="{{ adminUrl('categories') }}" class="small-box-footer">
                                {{ trans('lang.more_info') }}
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- clients -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $clients_count }}</h3>

                                <p>{{ trans('lang.clients') }}</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <a href="{{ adminUrl('clients') }}" class="small-box-footer">
                                {{ trans('lang.more_info') }}
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- admins-->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $users_count }}</h3>

                                <p>{{ trans('lang.users') }}</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <a href="{{ adminUrl('users') }}" class="small-box-footer">
                                @lang('lang.more_info')
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- end row stats -->

                <!-- start chart orders stats -->
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card bg-gradient-navy">
                            <div class="card-header border-default">
                                <h3 class="card-title float-left">
                                    <i class="fas fa-shopping-bag mr-1"></i>
                                    @lang('lang.orders-chart')
                                </h3>
                            </div>

                            <div class="card-body">
                                <canvas class="chart chartjs-render-monitor" id="line-chart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 368px;"
                                    width="368" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end chart orders stats -->
            </div>
            <!-- card-body -->
        </div>
        <!-- card -->
    </section>
    <!-- content -->
@endsection

@push('css')
@endpush

@push('js')
    <!-- ChartJS -->
    <script src="{{ url('assets/dashboard/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ url('assets/dashboard/plugins/sparklines/sparkline.js') }}"></script>

    <script>
        $(() => {

            // Sales graph chart
            var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d')
            // $('#revenue-chart').get(0).getContext('2d');

            var salesGraphChartData = {
                labels: [
                    '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12',
                ],
                datasets: [{
                    label: '{{ trans('lang.orders_count') }}',
                    fill: false,
                    borderWidth: 2,
                    lineTension: 0,
                    spanGaps: true,
                    borderColor: '#efefef',
                    pointRadius: 3,
                    pointHoverRadius: 7,
                    pointColor: '#efefef',
                    pointBackgroundColor: '#efefef',
                    data: [
                        @foreach ($chart_data as $item)
                            {{ $item }},
                        @endforeach
                    ]
                }]
            }

            var salesGraphChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            fontColor: '#efefef'
                        },
                        gridLines: {
                            display: false,
                            color: '#efefef',
                            drawBorder: false
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            stepSize: 1000,
                            fontColor: '#efefef'
                        },
                        gridLines: {
                            display: true,
                            color: '#efefef',
                            drawBorder: false
                        }
                    }]
                }
            }

            // This will get the first returned node in the jQuery collection.
            // eslint-disable-next-line no-unused-vars
            var salesGraphChart = new Chart(salesGraphChartCanvas, { // lgtm[js/unused-local-variable]
                type: 'line',
                data: salesGraphChartData,
                options: salesGraphChartOptions
            });
        });
    </script>
@endpush
