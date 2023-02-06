@include('dashboard.layouts.header')
@include('dashboard.layouts.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @include('dashboard.layouts.loading')
    @yield('braidcrump')
    <div class="content-container px-3
    ">
        @yield('content')
    </div>
</div>

@include('dashboard.layouts.footer')
@include('_partial._messages')
