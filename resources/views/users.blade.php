@extends('layouts.app')

@section('styles')
    <!-- DataTables CSS -->
    <link href="{{ asset('vendor/dataTables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/dataTables/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{asset('vendor/select2/css/select2.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('vendor/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>

@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Users</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    DataTables Advanced Tables
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover" id="users_table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>E-mail</th>
                            <th>Roles</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                @php( $roleUser = [])
                                <td>@foreach ($user->roles as $role)
                                        <span class="badge label-primary">{{ $role->name }} </span>
                                    @endforeach</td>
                                <td>
                                    <button id="roles_btn" class="btn btn-primary" data-toggle="modal"
                                            data-target="#roles_modal" data-id="{{ $user->id }}"
                                            data-roles="@foreach ($user->roles as $role){{ $role->id }} @endforeach">
                                        Roles
                                    </button>
                                    <a href="{{ URL::to('users').'/'.$user->id }}" id="view_btn" class="btn green">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>E-mail</th>
                            <th>Roles</th>
                            <th>Options</th>
                        </tr>
                        </tfoot>
                    </table>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
        <div class="modal fade" id="roles_modal" tabindex="-1" role="dialog"
             aria-labelledby="roleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
                    </div>
                    <div class="modal-body">
                        <form id="role-form" class="form-horizontal" method="post">
                            {{ csrf_field() }}
                            <label for="roles" class="control-label">roles:</label>
                            <select id="roles" class="form-control" name="roles[]"
                                    multiple="multiple">

                            </select>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Close
                        </button>
                        <input type="submit" form="role-form" class="btn btn-default" value="Submit">
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script src="{{ asset('vendor/dataTables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/dataTables/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{asset('vendor/select2/js/select2.full.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#dataTables').DataTable({
                responsive: true
            });
            $("#roles").select2({
                placeholder: "Select a role",
                width: '100%'
            });
            $(document).on("click", "#roles_btn", function () {
                var str = $(this).data('roles');
                var userId = $(this).data('id');
                $("#role-form").attr("action", "{{ URL::to('users/updateRoles') }}/" + userId);
                var arr = str.split(" ").slice(0, -1);
                @foreach($roles as $role)
                if ($.inArray('{{ $role->id }}', arr) != -1) {
                    $("#roles").append('<option value="{{ $role->id }}" selected>{{ $role->name }}</option>');
                } else {
                    $("#roles").append('<option value="{{ $role->id }}">{{ $role->name }}</option>');

                }
                @endforeach

            });

            $('#role-form').submit(function (e) {
                e.preventDefault();
                var form = $(this);
                var data = form.serialize();
                var action = form.attr('action');

                $.ajax({
                    type: 'POST',
                    url: action,
                    data: data,
                    success: function (data) {
                    },
                    error: function (data) {
                    }
                });
            });
        });
    </script>

@endsection
