<div class="row">
    <!-- Role name field -->
    <div class="col-12">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <div class="option">
                {!! Form::label('name', trans('lang.role_name2'), ['class' => 'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::text('name', old('name'), [
                'class' => 'form-control',
                'placeholder' => trans('lang.role_name2'),
            ]) !!}

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <!-- Role description field -->
    <div class="col-12">
        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
            {!! Form::label('description', trans('lang.description'), ['class' => 'form-label']) !!}

            {!! Form::textarea('description', old('description'), [
                'class' => 'form-control',
                'placeholder' => trans('lang.description'),
                'rows' => '4',
            ]) !!}

            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<!-- end row -->
@php
    $mode_class = isset($role) ? 'yellow' : 'blue';
    $btn_class = isset($role) ? 'warning' : 'primary';

    $models = ['users', 'roles', 'products', 'categories', 'clients','orders'];
    $maps = ['create', 'read', 'update', 'delete'];
@endphp

<!-- start permissions -->
<div class="row mt-3">
    <div class="col-12">
        <div class="card card-{{ $mode_class }} card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                    <li class="pt-2 px-3">
                        <h3 class="card-title"> <i class="fa fa-unlock"></i> {{ trans('lang.permissions') }}</h3>
                    </li>
                    @foreach ($models as $key => $model)
                        <li class="nav-item">
                            <a class="nav-link {{ $key == 0 ? 'active' : '' }}"
                                id="custom-tabs-{{ $model }}-pill" data-toggle="pill"
                                href="#custom-tabs-{{ $model }}" role="tab"
                                aria-controls="custom-tabs-{{ $model }}"
                                aria-selected="false">{{ trans('lang.' . $model) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                    @foreach ($models as $key => $model)
                        <div class="tab-pane fade {{ $key == 0 ? 'active show' : '' }}"
                            id="custom-tabs-{{ $model }}" role="tabpanel"
                            aria-labelledby="custom-tabs-{{ $model }}">

                            <ul class="list-unstyled d-flex">
                                @foreach ($maps as $map)
                                    <li>
                                        <div class="form-group clearfix">
                                            <div class="icheck-{{ $mode_class }} d-inline">
                                                <input name='permissions[]' type="checkbox"
                                                    id="{{ $map . '_' . $model }}" value="{{ $map . '_' . $model }}"
                                                    {{ (isset($role) and $role->hasPermission($map . '_' . $model)) ? 'checked' : '' }}>
                                                <label for="{{ $map . '_' . $model }}">
                                                    {{ trans('lang.' . $map) }}
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
<!-- end row -->

<div class="form-group">
    <button class="btn btn-{{ $btn_class }}"><i class="fa fa-floppy-o"></i> {{ trans('lang.save') }}</button>
    <a href="{{ route('dashboard.roles.index') }}" class="btn btn-secondary">
        <i class="fa fa-history"></i>
        {{ trans('lang.cancel') }}
    </a>
</div>
<!-- en actions -->

@push('css')
    <link rel="stylesheet" href="{{ url('assets/dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush
