@php
    $title = trans('lang.page_not_found');
@endphp

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
    <div class="err-page border-top">
        <div class="image text-center">
            <img src="{{ url('assets/dist/images/errors/404-not-found.svg') }}" alt="404">
        </div>
        <div class="error-text">
            <h5 class="mt-4">{{ trans('lang.page_not_found') }}</h5>
            <a href="{{ adminUrl('') }}" class="btn btn-primary mt-4"><i class="fa fa-history"></i>
                {{ trans('lang.redirect_to_home') }}
            </a>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .err-page {
            padding-top: 100px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            width: 100%;
        }

        .err-page img {
            width: 100%;
        }

        .error-text {
            text-align: center
        }

        @media (min-width:768px) {
            .err-page .image {
                width: 400px
            }
        }
    </style>
@endpush
