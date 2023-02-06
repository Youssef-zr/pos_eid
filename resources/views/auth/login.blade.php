@extends('layouts.app')

@section('content')
    <div class="bg"
        {{-- style="background:url('https://www.wallmur.com/media/catalog/pdata/cache/1/image/1100x/040ec0/b/h/vintage-floral-art-wallpaper-mural-wm-44190781-31485987.jpg') no-repeat center;background-size:contain"> --}}
        style="background:url('https://www.wallmur.com/media/catalog/pdata/cache/1/image/1100x/040ec0/b/h/vintage-floral-art-wallpaper-mural-wm-44190781-31485986.jpg') no-repeat center;background-size:contain">
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height:100vh">

                <div class="col-md-5 col-lg-5 mt-5">
                    <div class="card form-card">
                        <div class="card-body">
                            <div class="card-avatar">
                                <img src="{{ url('assets/dashboard/dist/img/avatar5.png') }}" alt="user icon">
                            </div>
                            <div class="card-head">
                                <h1 class="text-center">{{ trans('lang.app_name') }}</h1>
                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                @if (session()->has('userStatus'))
                                    <p class="alert alert-danger">{{ session()->get('userStatus') }}</p>
                                @endif

                                <div class="form-group">
                                    <label for="email" class="form-label text-md-right">{{ trans('lang.email') }}</label>
                                    <div class="form-relative">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus
                                            placeholder="{{ trans('lang.email') }}">
                                        <div class="icon text-primary"><i class="fa fa-envelope"></i></div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password"
                                        class="form-label text-md-right">{{ trans('lang.password') }}</label>
                                    <div class="form-relative">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password"
                                            placeholder="{{ trans('lang.password') }}">
                                        <div class="icon text-primary"><i class="fa fa-lock"></i></div>
                                        <div class="show-password" title="{{ trans('en.show') }}"><i class="fa fa-eye"></i>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="icheck-primary">
                                        <input type="checkbox" name="remember" id="remember" checked="checked">
                                        <label for="remember">
                                            {{ trans('lang.remember_me') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn bg-primary btn-block btn-flat">
                                        <i class="fa fa-unlock"></i> {{ trans('lang.login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
