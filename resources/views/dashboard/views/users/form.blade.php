<div class="row">
    <!-- User name field -->
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <div class="option">
                {!! Form::label('name', trans('lang.name'), ['class' => 'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::text('name', old('name'), [
                'class' => 'form-control',
                'placeholder' => trans('lang.user_name_placeholder'),
            ]) !!}

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <!-- phone field -->
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
            <div class="option">
                {!! Form::label('phone', trans('lang.phone'), ['class' => 'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => '06xxxxxxxx']) !!}

            @if ($errors->has('phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<!-- end row -->

<div class="row">
    <!-- adress field -->
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('adress') ? 'has-error' : '' }}">
            {!! Form::label('adress', trans('lang.adress'), ['class' => 'form-label']) !!}
            {!! Form::text('adress', old('adress'), [
                'class' => 'form-control',
                'placeholder' => trans('lang.user_adress_placeholder'),
            ]) !!}

            @if ($errors->has('adress'))
                <span class="help-block">
                    <strong>{{ $errors->first('adress') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <!-- User email field -->
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <div class="option">
                {!! Form::label('email', trans('lang.email'), ['class' => 'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => trans('lang.email')]) !!}

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<!-- end row -->

<div class="row">
    <!-- User password field -->
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            <div class="option">
                {!! Form::label('password', trans('lang.password'), ['class' => 'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            <div class="form-relative">
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => trans('lang.password')]) !!}
                <div class="icon"><i class="fa fa-lock"></i></div>
                <div class="show-password" title="show password" data-toggle="tooltip"><i class="fa fa-eye"></i></div>
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

    <!-- User confirm-password field -->
    @if (!isset($user))
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('confirm-password') ? 'has-error' : '' }}">
                <div class="option">
                    {!! Form::label('confirm-password', trans('lang.confirm-password'), ['class' => 'form-label']) !!}
                    <span class="star text-danger">*</span>
                </div>
                <div class="form-relative">
                    {!! Form::password('confirm-password', [
                        'class' => 'form-control',
                        'placeholder' => trans('lang.confirm-password'),
                    ]) !!}
                    <div class="icon"><i class="fa fa-lock"></i></div>
                    <div class="show-password" title="show password" data-toggle="tooltip"><i class="fa fa-eye"></i>
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
    @endif
</div>
{{-- end row --}}

<div class="row">
    <!-- User status field -->
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
            {!! Form::label('status', trans('lang.status'), ['class' => 'form-label']) !!}
            {!! Form::select('status', user_status(), null, [
                'class' => 'form-control',
                'placeholder' => trans('lang.status'),
            ]) !!}

            @if ($errors->has('status'))
                <span class="help-block">
                    <strong>{{ $errors->first('status') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <!-- User role field -->
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}">
            {!! Form::label('role', trans('lang.role'), ['class' => 'form-label']) !!}
            {!! Form::select('role', $roles, old('role', isset($role) ? $role : null), [
                'class' => 'form-control',
                'placeholder' => trans('lang.role'),
            ]) !!}

            @if ($errors->has('role'))
                <span class="help-block">
                    <strong>{{ $errors->first('role') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<!-- end row -->
@php
    $save_class = isset($user) ? 'btn-warning' : 'btn-primary';
@endphp

<div class="form-group">
    <button class="btn {{ $save_class }}"><i class="fa fa-floppy-o"></i> {{ trans('lang.save') }}</button>
    <a href="{{ route('dashboard.users.index') }}" class="btn btn-secondary"><i class="fa fa-history"></i>
        {{ trans('lang.cancel') }}</a>
</div>
<!-- en actions -->

@push('css')
    <style>
        .btn {
            position: relative;
            font-size: 16px
        }

        .btn i.float {
            margin-right: 10px
        }

        .form-relative .show-password {
            position: absolute;
            right: 11px;
            top: 6px;
            cursor: pointer;
        }
    </style>
@endpush
