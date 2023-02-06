<div class="row">
    <!-- product category field -->
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
            <div class="option">
                {!! Form::label('category_id', trans('lang.' . 'category'), ['class' => 'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>

            {!! Form::select('category_id', $categories, old('category_id'), [
                'class' => 'form-control',
                'placeholder' => trans('lang.category'),
            ]) !!}

            @if ($errors->has('category_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('category_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<!-- end row -->

<div class="row">
    <!-- product title field -->
    @foreach ($locale_langs as $locale)
        <div class="col-md-6">
            <div class="form-group {{ $errors->has($locale . '.title') ? 'has-error' : '' }}">
                <div class="option">
                    {!! Form::label($locale . '.title', trans('lang.' . $locale . '.title'), ['class' => 'form-label']) !!}
                    <span class="star text-danger">*</span>
                </div>
                {!! Form::text(
                    $locale . '[title]',
                    old($locale . 'title') || isset($product) ? $product->translate($locale)->title : '',
                    [
                        'class' => 'form-control',
                        'placeholder' => trans('lang.' . $locale . '.title'),
                        'id' => $locale . '.title',
                    ],
                ) !!}

                @if ($errors->has($locale . '.title'))
                    <span class="help-block">
                        <strong>{{ $errors->first($locale . '.title') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    @endforeach

    <!-- product description field -->
    @foreach ($locale_langs as $locale)
        <div class="col-md-12">
            <div class="form-group {{ $errors->has($locale . '.description') ? 'has-error' : '' }}">
                <div class="option">
                    {!! Form::label($locale . '.description', trans('lang.' . $locale . '.description'), ['class' => 'form-label']) !!}
                    <span class="star text-danger">*</span>
                </div>
                {!! Form::textarea(
                    $locale . '[description]',
                    old($locale . 'description') || isset($product) ? $product->translate($locale)->description : '',
                    [
                        'class' => 'form-control ckeditor',
                        'placeholder' => trans('lang.' . $locale . '.description'),
                        'id' => $locale . '.description',
                    ],
                ) !!}

                @if ($errors->has($locale . '.description'))
                    <span class="help-block">
                        <strong>{{ $errors->first($locale . '.description') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    @endforeach
</div>
<!-- end row -->

<div class="row mt-2">
    <!-- purchse price field -->
    <div class="col-12 col-md-4">
        <div class="form-group {{ $errors->has('purchase_price') ? 'has-error' : '' }}">

            <div class="option">
                {!! Form::label('purchase_price', trans('lang.' . 'purchase_price'), ['class' => 'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>

            {!! Form::number('purchase_price', old('purchase_price'), [
                'class' => 'form-control arabicNumbers',
                'placeholder' => trans('lang.purchase_price'),
            ]) !!}

            @if ($errors->has('purchase_price'))
                <span class="help-block">
                    <strong>{{ $errors->first('purchase_price') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <!-- sale price field -->
    <div class="col-12 col-md-4">
        <div class="form-group {{ $errors->has('sale_price') ? 'has-error' : '' }}">
            <div class="option">
                {!! Form::label('sale_price', trans('lang.' . 'sale_price'), ['class' => 'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>

            {!! Form::number('sale_price', old('sale_price'), [
                'class' => 'form-control arabicNumbers',
                'placeholder' => trans('lang.sale_price'),
            ]) !!}

            @if ($errors->has('sale_price'))
                <span class="help-block">
                    <strong>{{ $errors->first('sale_price') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <!-- stock qty field -->
    <div class="col-12 col-md-4">
        <div class="form-group {{ $errors->has('stock') ? 'has-error' : '' }}">
            <div class="option">
                {!! Form::label('stock', trans('lang.' . 'stock'), ['class' => 'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>

            {!! Form::number('stock', old('stock'), [
                'class' => 'form-control arabicNumbers',
                'placeholder' => trans('lang.stock'),
            ]) !!}

            @if ($errors->has('stock'))
                <span class="help-block">
                    <strong>{{ $errors->first('stock') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<!-- end row -->

<div class="row">
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
                @php
                    $image = isset($product) ? $product->image : url('assets/dist/storage/products/default.png');
                @endphp
                <img src="{{ $image }}" id="img-preview" class="img-thumbnail" style="width:300px">
            </div>

            @if ($errors->has('photo'))
                <span class="help-block">
                    <strong>{{ $errors->first('photo') }}</strong>
                </span>
            @endif
        </div>
    </div>
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

    <a href="{{ route('dashboard.products.index') }}" class="btn btn-secondary">
        <i class="fa fa-history"></i>
        {{ trans('lang.cancel') }}
    </a>
</div>
<!-- en actions -->

@push('css')
    <style>

    </style>
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.9.2/ckeditor.js"></script>
    <script>
        CKEDITOR.config.uiColor = "#9AB8F3";

        $("textarea").each(function() {
            let $localeLang = "en";

            if ($(this).attr('id') == "ar.description") {
                $localeLang = "ar"
            }

            CKEDITOR.replace($(this).attr("id"), {
                language: $localeLang
            });
        });
    </script>
    @if (isset($product))
        <script>
            $(() => {

                function toEnglishNumber(strNum) {
                    var ar = '٠١٢٣٤٥٦٧٨٩'.split('');
                    var en = '0123456789'.split('');
                    strNum = strNum.replace(/[٠١٢٣٤٥٦٧٨٩]/g, x => en[ar.indexOf(x)]);
                    strNum = strNum.replace(/[^\d]/g, '');
                    return strNum;
                }


                Object.entries($('.arabicNumbers')).forEach(element => {
                    var val = toEnglishNumber($(element[1]).val())
                    $(this).val("").val(val)

                });
            })
        </script>
    @endif
@endpush
