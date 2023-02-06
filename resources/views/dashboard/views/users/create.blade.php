@extends('dashboard.layouts.master')

@section('braidcrump')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1><i class="fa fa-users"></i> {{ trans('lang.users') }} </h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{adminurl('users')}}"><i class="fa fa-list"></i> {{ trans('lang.users_list') }}</a></li>
                <li class="breadcrumb-item active"><i class="fa fa-plus-circle"></i> {{ trans('lang.add') }}</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
@endsection

@section('content')
<div class="box text-capitalize">
    <div class="box-body">
        <!-- row -->
        <div class="row">
            <div class="col-xl-12">
              <div class="card card-primary mg-b-20">
                <div class="card-header">
                    <h4 class="title"><i class="fa fa-plus-circle"></i> {{ trans('lang.users_new') }} </h4>
                </div>
                <div class="card-body">
                    {!! Form::open(['route'=>'dashboard.users.store','method'=>'POST']) !!}
                        @include('dashboard.views.users.form')
                    {!! Form::close() !!}
                </div>
              </div>
            </div>
        <!-- row closed -->
        </div>
	<!-- Container closed -->
    </div>
</div>
@endsection
