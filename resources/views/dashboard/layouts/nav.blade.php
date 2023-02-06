 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
         <li class="nav-item">
             <a class="nav-link" id="toggleMenu" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
             <a href="{{ route('dashboard.index') }}" class="nav-link">{{ trans('lang.home') }}</a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
             <a href="#" class="nav-link">{{ trans('lang.contact') }}</a>
         </li>
     </ul>

     <!-- Right navbar links -->
     <ul class="navbar-nav ml-auto">
         <!-- Navbar Search -->
         <li class="nav-item">
             <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                 <i class="fas fa-search"></i>
             </a>
             <div class="navbar-search-block">
                 <form class="form-inline">
                     <div class="input-group input-group-sm">
                         <input class="form-control form-control-navbar" type="search" placeholder="Search"
                             aria-label="Search">
                         <div class="input-group-append">
                             <button class="btn btn-navbar" type="submit">
                                 <i class="fas fa-search"></i>
                             </button>
                             <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                 <i class="fas fa-times"></i>
                             </button>
                         </div>
                     </div>
                 </form>
             </div>
         </li>

         <!-- langs Dropdown Menu -->
         <li class="nav-item dropdown">
             <a class="nav-link" data-toggle="dropdown" href="#" title="{{ trans('lang.change_language') }}">
                 <i class="fa fa-globe"></i>
             </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 @php
                     $langs = LaravelLocalization::getSupportedLocales();
                     $i = 0;
                 @endphp
                 @foreach ($langs as $localeCode => $properties)
                     <a hrefLang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}"
                         class="dropdown-item">
                         <i class="fa fa-flag"></i> {{ $properties['native'] }}
                     </a>
                     @php
                         $i++;
                         if ($i < count($langs)) {
                             echo '<div class="dropdown-divider"></div>';
                         }
                     @endphp
                 @endforeach
             </div>
         </li>

         <!-- Profile Dropdown Menu -->
         <li class="nav-item dropdown">
             <a class="nav-link" data-toggle="dropdown" href="#" title="{{ trans('lang.profile') }}">
                 <i class="fa fa-user-o"></i>
             </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <!-- profile -->
                 <a href="{{ route('dashboard.user.profile', auth()->user()->id) }}" class="dropdown-item">
                     <i class="fa fa-user-o"></i> {{ trans('lang.account') }}
                 </a>

                 <div class="dropdown-divider"></div>

                 <!-- logout -->
                 <a href="{{ route('dashboard.user.logout') }}" class="dropdown-item">
                     <i class="fa fa-sign-out"></i> {{ trans('lang.logout') }}
                 </a>
             </div>
         </li>

         <!-- Notifications Dropdown Menu -->
         <li class="nav-item dropdown">
             <a class="nav-link" data-toggle="dropdown" href="#">
                 <i class="far fa-bell"></i>
                 <span class="badge badge-warning navbar-badge">15</span>
             </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <span class="dropdown-item dropdown-header">15 Notifications</span>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <i class="fas fa-envelope mr-2"></i> 4 new messages
                     <span class="float-right text-muted text-sm">3 mins</span>
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <i class="fas fa-users mr-2"></i> 8 friend requests
                     <span class="float-right text-muted text-sm">12 hours</span>
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <i class="fas fa-file mr-2"></i> 3 new reports
                     <span class="float-right text-muted text-sm">2 days</span>
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
             </div>
         </li>
         <li class="nav-item">
             <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                 <i class="fas fa-expand-arrows-alt"></i>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                 <i class="fas fa-th-large"></i>
             </a>
         </li>
     </ul>
 </nav>
 <!-- /.navbar -->
