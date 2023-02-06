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
                        <li class="breadcrumb-item active"><i class="fa fa-lock"></i> {{ trans('lang.permissions') }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('content')
    <section class="section-error border-top">
        <div class="row">
            <div class="col-12 col-md-5 col-lg-3 mx-auto">
                <div class="error-img">
                    <img src="{{ url('assets/dist/images/errors/403-access-denied.svg') }}" class="img-responsive"
                        alt="acess denied">
                </div>
            </div>
            <div class="col-12">
                <div class="error-msg">
                    <h5 class="text-center">{{ trans('lang.403-error-msg') }}</h5>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('css')
    <style>
        .section-error {
            padding-top: 150px;
        }

        .section-error .error-img {
            margin-bottom: 20px;
        }
    </style>
@endpush
