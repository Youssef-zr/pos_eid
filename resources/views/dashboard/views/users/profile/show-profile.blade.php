@extends('dashboard.layouts.master')

@section('braidcrump')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fa fa-pencil"></i> {{ trans('lang.update_profile') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ adminurl('users') }}"><i class="fa fa-users"></i>
                                {{ trans('lang.users') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active"><i class="fa fa-pencil"></i> @lang('lang.update')</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="box text-capitalize px-3">
        <div class="box-body">
            <!-- row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <!-- Profile Image -->
                        <div class="col-12 col-md-5 col-lg-5">
                            <div class="card card-primary card-outline">
                                <div class="card-body pb-2 box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle" src="{{ url($user->path) }}"
                                            alt="User profile picture">
                                        <h3 class="profile-username text-center">{{ $user->name }}</h3>
                                        <p class="badge bg-warning"><i class="fa fa-tag mx-1"></i>
                                            {{ $user->roles[0]->display_name }}</p>
                                    </div>
                                    <ul class="list-group list-group-unbordered mb-2">
                                        <li class="list-group-item">
                                            <b>
                                                <i class="fa fa-user-o mr-1"></i>
                                                {{ trans('lang.email') }}
                                            </b>
                                            <a class="float-right">{{ $user->email }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>
                                                <i class="fa fa-phone mr-1"></i>
                                                {{ trans('lang.phone') }}
                                            </b>
                                            <a class="float-right">{{ $user->phone }}</a>
                                        </li>
                                        <li class="list-group-item" style="border-bottom: none">
                                            <b>
                                                <i class="fa fa-calendar mr-1"></i>
                                                {{ trans('lang.last_login') }}
                                            </b>
                                            <a class="float-right text-lowercase">{{ auth()->user()->lastLogin() }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Informations and password -->
                        <div class="col-12 col-md-7 col-lg-7">
                            <div class="card card-primary card-outline">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#settings" data-toggle="tab">
                                                <i class="fa fa-list"></i> {{ trans('lang.information') }}
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#password-tab" data-toggle="tab">
                                                <i class="fa fa-lock"></i> {{ trans('lang.change_password') }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body pb-2">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="settings">
                                            {!! Form::open([
                                                'route' => ['dashboard.user.update_profile', $user->id],
                                                'method' => 'patch',
                                                'files' => 'true',
                                            ]) !!}

                                            <div class="row">
                                                <!-- name field -->
                                                <div class="col-12">
                                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                                        <div class="option">
                                                            <label for="name">
                                                                <i class="fa fa-user-o form-label mr-1"></i>
                                                                {{ trans('lang.name') }}
                                                            </label>
                                                            <span class="star text-danger">*</span>
                                                        </div>

                                                        {!! Form::text('name', old('name') ?? $user->name, [
                                                            'class' => 'form-control',
                                                            'placeholder' => 'votre nom',
                                                        ]) !!}

                                                        @if ($errors->has('name'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- phone field -->
                                                <div class="col-12">
                                                    <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                                                        <div class="option">
                                                            <label for="phone">
                                                                <i class="fa fa-phone form-label mr-1"></i>
                                                                {{ trans('lang.phone') }}
                                                            </label>
                                                            <span class="star text-danger">*</span>
                                                        </div>

                                                        {!! Form::text('phone', old('phone') ?? $user->phone, [
                                                            'class' => 'form-control',
                                                            'placeholder' => '06xxxxxxxx',
                                                        ]) !!}

                                                        @if ($errors->has('phone'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('phone') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- email field -->
                                                <div class="col-12">
                                                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                                        <div class="option">
                                                            <label for="email">
                                                                <i class="fa fa-envelope-o mr-1"></i>
                                                                {{ trans('lang.email') }}
                                                            </label>
                                                            <span class="star text-danger">*</span>
                                                        </div>

                                                        {!! Form::text('email', old('email') ?? $user->email, [
                                                            'class' => 'form-control',
                                                            'placeholder' => '06xxxxxxxx',
                                                        ]) !!}

                                                        @if ($errors->has('email'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- photo field -->
                                                <div class="col-12">
                                                    <div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }}">
                                                        <label for="photo">
                                                            <i class="fa fa-image mr-1"></i>
                                                            {{ trans('lang.photo') }}
                                                        </label>

                                                        <small id="status_block" class="form-text text-muted mt-0">
                                                            {{ trans('lang.image_validation') }}
                                                        </small>

                                                        <div class="box-input js mt-2">
                                                            {!! Form::file('photo', [
                                                                'class' => 'inputfile inputfile-1',
                                                                'placeholder' => '06xxxxxxxx',
                                                                'id' => 'file-1',
                                                                'data-multiple-caption' => '{count} files selected',
                                                            ]) !!}
                                                            <label for="file-1">
                                                                <i class="fa fa-upload"></i>
                                                                <span>{{ trans('lang.choose-file') }}&hellip;</span>
                                                            </label>
                                                        </div>

                                                        <div class="image">
                                                            <img src="{{ $user->image }}" id="img-preview"
                                                                class="img-thumbnail" style="width:120px">
                                                        </div>

                                                        @if ($errors->has('photo'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('photo') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-pencil"></i>
                                                    {{ trans('lang.save') }}
                                                </button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>

                                        <!-- password area -->
                                        <div class="tab-pane" id="password-tab">

                                            {!! Form::open([
                                                'route' => ['dashboard.user.change_password', $user->id],
                                                'method' => 'patch',
                                            ]) !!}
                                            <div class="row form-card">
                                                <!--  User password field -->
                                                <div class="col-md-8">
                                                    <div
                                                        class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                                        {!! Form::label('password', trans('lang.password'), ['class' => 'form-label']) !!}
                                                        <div class="form-relative">
                                                            {!! Form::password('password', [
                                                                'class' => 'form-control',
                                                                'placeholder' => trans('lang.password'),
                                                                'id' => 'password',
                                                            ]) !!}
                                                            <div class="icon"><i class="fa fa-lock"></i></div>
                                                            <div class="show-password"
                                                                title="{{ trans('lang.show_password') }}"
                                                                data-toggle="tooltip"><i class="fa fa-eye"></i></div>
                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        @if ($errors->has('password'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <!--  User confirm-password field -->
                                                <div class="col-md-8">
                                                    <div
                                                        class="form-group {{ $errors->has('confirm-password') ? 'has-error' : '' }}">
                                                        {!! Form::label('confirm-password', trans('lang.confirm-password'), ['class' => 'form-label']) !!}
                                                        <div class="form-relative">
                                                            {!! Form::password('confirm-password', [
                                                                'class' => 'form-control',
                                                                'placeholder' => trans('lang.confirm-password'),
                                                            ]) !!}
                                                            <div class="icon"><i class="fa fa-lock"></i></div>
                                                            <div class="show-password"
                                                                title="{{ trans('lang.show_password') }}"
                                                                data-toggle="tooltip"><i class="fa fa-eye"></i>
                                                            </div>
                                                            @error('confirm-password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        @if ($errors->has('confirm-password'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('confirm-password') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- end row --}}
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-pencil"></i>
                                                    {{ trans('lang.update') }}
                                                </button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#btnEdit').on('click', function() {
                $('input').removeAttr('disabled');
                $('button[type="submit"]').removeClass('d-none');
            })
        });
    </script>

    @if ($errors->has('password'))
        <script>
            $('a[href="#settings"]').removeClass('active');
            $('a[href="#password-tab"]').addClass('active');
            $('#settings').removeClass('active');
            $('#password-tab').addClass('active');
        </script>
    @endif
@endpush
