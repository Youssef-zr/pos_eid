<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{ config('app.name') }} - {{ trans('lang.login') }}</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('assets/dashboard/plugins/fontawesome-free/css/all.min.css') }} ">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ url('assets/dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/dashboard/dist/css/adminlte.min.css') }}"><!-- Theme style -->
    @if (app()->getLocale() == 'ar')
        <!-- CSS -->
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ url('assets/dashboard/dist/css/rtl.css') }}">

        {{-- google fonts --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Cairo', sans-serif;
            }
        </style>
    @else
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    @endif
    <style>
        body {
            background: #fff;
        }

        .card {
            border: 2px solid #e6bd85;
            border-radius: 10px
        }

        .card-head>h1 {
            color: #007bff;
            text-shadow: 2px 4px 3px rgba(0, 0, 0, .3);
            margin-bottom: 22px;
        }

        .form-relative {
            position: relative;
        }

        .form-group .icheck-primary {
            margin-left: 3px
        }

        .form-relative input {
            padding-left: 40px;
            padding-right: 35px;
        }

        .form-relative .icon {
            position: absolute;
            top: 4px;
            font-size: 21px;
            left: 8px;
            border-right: 1px solid #eee;
            padding-right: 5px
        }

        .form-card {
            position: relative;
            padding-top: 40px;
            background: #1f1e1ea9 !important
        }

        .form-card .card-avatar {
            width: 125px;
            height: 125px;
            position: absolute;
            top: -73px;
            left: 50%;
            transform: translateX(-54px);
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid #e6bd85;
        }

        .form-card .card-avatar img {
            width: 100%
        }

        .form-card .show-password {
            position: absolute;
            right: 11px;
            top: 6px;
            cursor: pointer;
        }

        .form-card .form-label {
            color: #fff
        }

        [class*="icheck-"]>label {
            color: #fff
        }
    </style>
    @if (app()->getLocale() == 'ar')
        <style>
            .form-card .show-password {
                right: auto;
                left: 11px !important;
            }

            .form-relative .icon {
                left: auto;
                right: 8px;
                border-right: none;
                border-left: 1px solid #eee;
                padding-right: 0;
                padding-left: 5px;
            }

            .form-relative input {
                padding-right: 40px;
                padding-left: 35px;
            }

            [class*="icheck-"]>label {
                padding-left: 0;
                padding-right: 29px;
            }

            [class*="icheck-"]>input:first-child+input[type="hidden"]+label::before,
            [class*="icheck-"]>input:first-child+label::before {
                margin-right: -29px !important;
                margin-left: auto !important;
            }
        </style>
    @endif
</head>

<body>
