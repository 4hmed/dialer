@extends('layouts.app')

@section('style')
    <!-- DataTables CSS -->
    <link href="{{ asset('vendor/dataTables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/dataTables/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">

@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Blank</h1>
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
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('vendor/dataTables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/dataTables/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTables').DataTable({
                responsive: true
            });
        });
    </script>

@endsection
