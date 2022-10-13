<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        pos eid
        @if (isset($title))
            - {{ $title }}
        @endif
    </title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('assets/dashboard/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('assets/dashboard/dist/css/adminlte.min.css') }}">

    @if (app()->getLocale() == 'ar')
        <!-- CSS -->
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css">

        {{-- custom rtl style --}}
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
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        @include('dashboard.layouts.nav')
