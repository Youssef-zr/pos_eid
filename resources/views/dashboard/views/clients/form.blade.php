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
                'placeholder' => trans('lang.client_name_placeholder'),
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
                'placeholder' => trans('lang.client_adress_placeholder'),
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
            {!! Form::label('email', trans('lang.email'), ['class' => 'form-label']) !!}

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
