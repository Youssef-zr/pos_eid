@extends('dashboard.layouts.master')

@section('braidcrump')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fa fa-dashboard"></i> {{ trans('lang.dashboard') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item d-flex align-items-center">
                            <i class="fa fa-dashboard mx-1"></i>
                            {{ trans('lang.dashboard') }}
                        </li>
                        <li class="breadcrumb-item active"><i class="fa fa-users"></i> {{ trans('lang.users_list') }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-body">
            <!-- actions-->
            <div class="actions d-flex">
                <!-- more actions -->
                <div class="btn-group" id="more-actions">
                    <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-cogs"></i>
                        {{ trans('lang.actions') }}</button>
                    <button type="button" class="btn btn-warning btn-sm dropdown-toggle dropdown-icon"
                        data-toggle="dropdown">
                        <span class="sr-only">Toggle
                            Dropdown
                        </span>
                    </button>
                    <div class="dropdown-menu" role="menu" id="global-actions">
                        <label class="dropdown-item mb-0" id="btn-pdf"></label>
                        <label class="dropdown-item mb-0" id="btn-excel"></label>
                    </div>
                </div>

                <!-- new record -->
                @permission('create_users')
                    <div id="add-new">
                        <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary btn-flat">
                            <i class="fa fa-plus-circle"></i>
                            {{ trans('lang.add') }}
                        </a>
                    </div>
                @endpermission
            </div>

            <!-- Main content -->
            <section class="content">
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <table id="example" class="stripe row-border order-column text-capitalize w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('lang.photo') }}</th>
                                <th>{{ trans('lang.name') }}</th>
                                <th>{{ trans('lang.email') }}</th>
                                <th>{{ trans('lang.status') }}</th>
                                <th>{{ trans('lang.last_login') }}</th>
                                <th>{{ trans('lang.role_name') }}</th>
                                <!-- check user has permission to update and delete users -->
                                @permission(['update_users', 'delete_users'])
                                    <th>{{ trans('lang.actions') }}</th>
                                @endpermission
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp

                            @foreach ($users as $user)
                                <tr>
                                    <td> {{ $i }} </td>
                                    <td>
                                        <img src="{{ $user->image}}" alt="{{ $user->path }}" class="user-photo">
                                    </td>
                                    <td> {{ $user->name }} </td>
                                    <td> {{ $user->email }} </td>

                                    <td>
                                        @php
                                            $status_class = $user->status == 'enabled' ? 'success' : 'warning';
                                        @endphp
                                        <span class="badge badge-pill badge-{{ $status_class }}"
                                            style="position: relative;">
                                            <span class="pulse" style="right:-15px"></span>
                                            {{ trans('lang.' . $user->status) }}
                                        </span>
                                    </td>

                                    <td>
                                        @php
                                            $lastLogin = $user->lastLogin() != trans('lang.user_not_loged_in') ? 'primary' : 'danger';
                                        @endphp
                                        <span class="text-lowercase badge badge-{{ $lastLogin }}">
                                            {{ $user->lastLogin() }}
                                        </span>
                                    </td>

                                    <td>
                                        @if (count($user->roles) > 0)
                                            @foreach ($user->roles as $role)
                                                <a href="{{ adminUrl('roles/' . $role->id . '/edit') }}"
                                                    class="badge badge-pill mr-1 {{ $role == 'developer' ? 'bg-maroon' : 'bg-warning' }}">
                                                    {{ $role->display_name }}
                                                </a>
                                            @endforeach
                                        @else
                                            <label class="badge badge-secondary">---</label>
                                        @endif
                                    </td>

                                    <!-- check user has permission to update and delete users -->
                                    @permission(['update_users', 'delete_users'])
                                        <td>
                                            <div class="btn-group">
                                                <button type="button"
                                                    class="btn btn-primary btn-sm">{{ trans('lang.actions') }}</button>
                                                <button type="button"
                                                    class="btn btn-primary btn-sm dropdown-toggle dropdown-icon"
                                                    data-toggle="dropdown">
                                                    <span class="sr-only">Toggle
                                                        Dropdown
                                                    </span>
                                                </button>
                                                <div class="dropdown-menu" role="menu" style="">
                                                    <!-- update user -->
                                                    @permission('update_users')
                                                        <label class="dropdown-item mb-0">
                                                            <a href="{{ adminurl('users/' . $user->id . '/edit') }}"
                                                                class="btn btn-warning btn-block btn-sm text-left"
                                                                title='{{ trans('lang.update') }}' data-toggle="tooltip">
                                                                <i class="fa fa-edit"></i>
                                                                {{ trans('lang.update') }}
                                                            </a>
                                                        </label>
                                                    @endpermission

                                                    <!-- delete user -->
                                                    @permission('delete_users')
                                                        <label class="dropdown-item mb-0">
                                                            <a href="#"
                                                                class="btn btn-danger bg-maroon btn-block btn-sm text-left delete-modal"
                                                                data-id="{{ $user->id }}" title='{{ trans('lang.delete') }}'
                                                                data-toggle="tooltip" data-modal="deleteUser">

                                                                <i class="fa fa-trash"></i>
                                                                {{ trans('lang.delete') }}
                                                            </a>
                                                        </label>
                                                    @endpermission
                                                </div>
                                            </div>
                                        </td>
                                    @endpermission
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- Container closed -->

                <!-- Modal Remove User-->
                @permission('delete_users')
                    <div class="modal text-left" id="deleteUser" style="overflow: hidden">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{ trans('lang.remove_modal_header') }}</h4>
                                        <button type="button" class="close hide-modal" data-modal="deleteUser"><i
                                                class="fa fa-times-circle"></i></button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <h3 class="mb2 text-center" style="color:#f39c12"><i
                                                class="fa fa-exclamation-triangle fa-3x"></i>
                                        </h3>
                                        <p class="text-center">
                                            {{ trans('lang.remove_modal_body') }}
                                        </p>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer" style="text-align: center !important">
                                        <form action="" data-url="{{ adminUrl('users') }}" method="post"
                                            style="display: none" id="form-delete">
                                            @csrf
                                            @method('delete')
                                        </form>
                                        <button type="button" class="btn btn-success confirm-delete btn-sm">
                                            <i class="fa fa-send"></i>
                                            {{ trans('lang.confirm') }}
                                        </button>
                                        <button type="button" class="btn btn-danger bg-maroon hide-modal btn-sm"
                                            data-modal="deleteUser">
                                            <i class="fa fa-times"></i>
                                            {{ trans('lang.cancel') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endpermission
                <!-- /.card -->
            </section>
            <!-- /.content -->
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" />
    <style>
        tbody tr td {
            position: relative;
        }

        .user-photo {
            width: 52px;
            height: 52px;
            position: absolute;
            top: 7px;
            left: 20px;
            border-radius: 50%
        }
    </style>
@endpush

@push('js')
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/b-2.1.1/b-html5-2.1.1/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.15/sorting/numeric-comma.js"></script>

    <script>
        $(() => {
            $table = $('#example').DataTable({
                direction: $dir,
                "order": [
                    [0, 'desc']
                ],
                "aLengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "{{ trans('lang.all') }}"]
                ],
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/" + $currentLang + ".json"
                },
                "columnDefs": [{
                        "width": "60px",
                        "targets": 0
                    },
                    {
                        "width": "180px",
                        "targets": 3
                    },
                    {
                        "width": "160px",
                        "targets": $('table').find('thead th').length - 1
                    },
                ],
                "buttons": [{
                        extend: 'excelHtml5',
                        className: "btn-success btn-sm btn-block",
                        charset: 'UTF-8',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        className: "btn-warning btn-sm btn-block",
                        charset: 'UTF-8',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                ],
            });

            // change style of buttons excel and pdf
            setTimeout(() => {
                $table.buttons().container().insertBefore('#example_filter');
                $('.buttons-excel').html('<i class="fa fa-file-excel-o"></i> {{ trans('lang.dt_excel') }}')
                    .appendTo("#btn-pdf");

                $('.buttons-pdf').html('<i class="fa fa-file-pdf-o"></i> {{ trans('lang.dt_pdf') }}')
                    .appendTo("#btn-excel");

                // move actions btns to filter container
                $('.actions').appendTo(".dt-buttons");
            }, 500);

        })
    </script>
@endpush
