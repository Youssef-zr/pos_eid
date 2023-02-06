<div class="row">
    <!-- User name field -->
    @foreach ($locale_langs as $locale)
        <div class="col-md-6">
            <div class="form-group {{ $errors->has($locale . '.name') ? 'has-error' : '' }}">
                <div class="option">
                    {!! Form::label($locale . '.name', trans('lang.' . $locale . '.name'), ['class' => 'form-label']) !!}
                    <span class="star text-danger">*</span>
                </div>
                {!! Form::text(
                    $locale . '[name]',
                    old($locale . 'name') || isset($category) ? $category->translate($locale)->name : '',
                    [
                        'class' => 'form-control',
                        'placeholder' => trans('lang.' . $locale . '.name'),
                        'id' => $locale . '.name',
                    ],
                ) !!}

                @if ($errors->has($locale . '.name'))
                    <span class="help-block">
                        <strong>{{ $errors->first($locale . '.name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    @endforeach
</div>
<!-- end row -->

@php
    $save_class = isset($category) ? 'btn-warning' : 'btn-primary';
@endphp

<div class="form-group">
    <button class="btn {{ $save_class }}">
        <i class="fa fa-floppy-o"></i>
        {{ trans('lang.save') }}
    </button>

    <a href="{{ route('dashboard.categories.index') }}" class="btn btn-secondary">
        <i class="fa fa-history"></i>
        {{ trans('lang.cancel') }}
    </a>
</div>
<!-- en actions -->
