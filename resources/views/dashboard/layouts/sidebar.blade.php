  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('dashboard.index') }}" class="brand-link">
          <img src="{{ url('assets/dashboard/dist/img/AdminLTELogo.png') }}" alt="{{ config('app.name') }} Logo"
              class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="{{ url(auth()->user()->path) }}" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <a href="{{ route('dashboard.user.profile', auth()->id()) }}"
                      class="d-block">{{ auth()->user()->name }}</a>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">

                  {{-- @permission(['show_home']) --}}
                  <li class="nav-item">
                      <a href="{{ adminUrl('/') }}" class="nav-link  {{ active_dashboard_item("dashboard")[0] }}">
                          <i class="nav-icon fa fa-dashboard"></i>
                          <p>
                              {{ trans('lang.home') }}
                          </p>
                      </a>
                  </li>
                  {{-- @endpermission --}}

                  <!-- Start categories -->
                  @permission(['read_categories', 'create_categories'])
                      <li class="nav-item {{ active_menu('categories')[0] }}">
                          <a href="#" class="nav-link {{ active_menu('categories')[1] }}">
                              <i class="nav-icon fas fa-tags"></i>
                              <p>
                                  {{ trans('lang.categories') }}
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <!-- new user -->
                              @permission('create_categories')
                                  <li class="nav-item">
                                      <a href="{{ route('dashboard.categories.create') }}"
                                          class="nav-link {{ setActive('categories/create') }}">
                                          <i class="fa fa-plus nav-icon"></i>
                                          <p>{{ trans('lang.add') }}</p>
                                      </a>
                                  </li>
                              @endpermission

                              <!--categories list -->
                              @permission('read_categories')
                                  <li class="nav-item">
                                      <a href="{{ route('dashboard.categories.index') }}"
                                          class="nav-link {{ setActive('categories') }}">
                                          <i class="fa fa-list nav-icon"></i>
                                          <p>{{ trans('lang.categories_list') }}</p>
                                      </a>
                                  </li>
                              @endpermission
                          </ul>
                      </li>
                  @endpermission
                  <!-- End categories -->

                  <!-- Start products -->
                  @permission(['read_products', 'create_products'])
                      <li class="nav-item {{ active_menu('products')[0] }}">
                          <a href="#" class="nav-link {{ active_menu('products')[1] }}">
                              <i class="nav-icon fa fa-product-hunt"></i>
                              <p>
                                  {{ trans('lang.products') }}
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <!-- new user -->
                              @permission('create_products')
                                  <li class="nav-item">
                                      <a href="{{ route('dashboard.products.create') }}"
                                          class="nav-link {{ setActive('products/create') }}">
                                          <i class="fa fa-plus nav-icon"></i>
                                          <p>{{ trans('lang.add') }}</p>
                                      </a>
                                  </li>
                              @endpermission

                              <!--products list -->
                              @permission('read_products')
                                  <li class="nav-item">
                                      <a href="{{ route('dashboard.products.index') }}"
                                          class="nav-link {{ setActive('products') }}">
                                          <i class="fa fa-list nav-icon"></i>
                                          <p>{{ trans('lang.products_list') }}</p>
                                      </a>
                                  </li>
                              @endpermission
                          </ul>
                      </li>
                  @endpermission
                  <!-- End products -->

                  <!-- Start clients -->
                  @permission(['read_clients', 'create_clients'])
                      <li class="nav-item {{ active_menu('clients')[0] }}">
                          <a href="#" class="nav-link {{ active_menu('clients')[1] }}">
                              <i class="nav-icon fas fa-users"></i>
                              <p>
                                  {{ trans('lang.clients') }}
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <!-- new user -->
                              @permission('create_clients')
                                  <li class="nav-item">
                                      <a href="{{ route('dashboard.clients.create') }}"
                                          class="nav-link {{ setActive('clients/create') }}">
                                          <i class="fa fa-plus nav-icon"></i>
                                          <p>{{ trans('lang.add') }}</p>
                                      </a>
                                  </li>
                              @endpermission

                              <!--clients list -->
                              @permission('read_clients')
                                  <li class="nav-item">
                                      <a href="{{ route('dashboard.clients.index') }}"
                                          class="nav-link {{ setActive('clients') }}">
                                          <i class="fa fa-list nav-icon"></i>
                                          <p>{{ trans('lang.clients_list') }}</p>
                                      </a>
                                  </li>
                              @endpermission
                          </ul>
                      </li>
                  @endpermission
                  <!-- End clients -->

                  <!-- Start orders -->
                  @permission(['read_orders', 'create_orders'])
                      <li class="nav-item {{ active_menu('orders')[0] }}">
                          <a href="#" class="nav-link {{ active_menu('orders')[1] }}">
                              <i class="nav-icon fas fa-shopping-bag"></i>
                              <p>
                                  {{ trans('lang.orders') }}
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <!--orders list -->
                              @permission('read_clients')
                                  <li class="nav-item">
                                      <a href="{{ route('dashboard.orders.index') }}"
                                          class="nav-link {{ setActive('orders') }}">
                                          <i class="fa fa-list nav-icon"></i>
                                          <p>{{ trans('lang.orders_list') }}</p>
                                      </a>
                                  </li>
                              @endpermission
                          </ul>
                      </li>
                  @endpermission
                  <!-- End orders -->

                  <!-- Start users -->
                  @permission(['read_users', 'create_users'])
                      <li class="nav-item {{ active_menu('users')[0] }}">
                          <a href="#" class="nav-link {{ active_menu('users')[1] }}">
                              <i class="nav-icon fas fa-users"></i>
                              <p>
                                  {{ trans('lang.users') }}
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <!-- new user -->
                              @permission('create_users')
                                  <li class="nav-item">
                                      <a href="{{ route('dashboard.users.create') }}"
                                          class="nav-link {{ setActive('users/create') }}">
                                          <i class="fa fa-plus nav-icon"></i>
                                          <p>{{ trans('lang.add') }}</p>
                                      </a>
                                  </li>
                              @endpermission

                              <!--users list -->
                              @permission('read_users')
                                  <li class="nav-item">
                                      <a href="{{ route('dashboard.users.index') }}"
                                          class="nav-link {{ setActive('users') }}">
                                          <i class="fa fa-list nav-icon"></i>
                                          <p>{{ trans('lang.users_list') }}</p>
                                      </a>
                                  </li>
                              @endpermission
                          </ul>
                      </li>
                  @endpermission
                  <!-- End users -->

                  <!-- Start roles -->
                  @permission(['read_roles', 'create_roles'])
                      <li class="nav-item {{ active_menu('roles')[0] }}">
                          <a href="#" class="nav-link {{ active_menu('roles')[1] }}">
                              <i class="nav-icon fas fa-unlock"></i>
                              <p>
                                  {{ trans('lang.permissions') }}
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <!-- new role -->
                              @permission('create_roles')
                                  <li class="nav-item">
                                      <a href="{{ route('dashboard.roles.create') }}"
                                          class="nav-link {{ setActive('roles/create') }}">
                                          <i class="fa fa-plus nav-icon"></i>
                                          <p>{{ trans('lang.add') }}</p>
                                      </a>
                                  </li>
                              @endpermission

                              <!-- roles list -->
                              @permission('read_roles')
                                  <li class="nav-item">
                                      <a href="{{ route('dashboard.roles.index') }}"
                                          class="nav-link {{ setActive('roles') }}">
                                          <i class="fa fa-list nav-icon"></i>
                                          <p>{{ trans('lang.roles_list') }}</p>
                                      </a>
                                  </li>
                              @endpermission
                          </ul>
                      </li>
                  @endpermission
                  <!-- End roles -->
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
