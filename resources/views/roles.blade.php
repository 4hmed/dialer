@extends('layouts.app')

@section('styles')
    <!-- DataTables CSS -->
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
                    @if(Entrust::can('store-role'))
                    <button id="store_btn" class="btn btn-primary" data-toggle="modal" data-target="#store_modal">New Roles</button>
                    @endif
                        <table class="table table-striped table-bordered table-hover" id="rols_table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Role</th>
                            <th>Role Description</th>
                            <th>Permissions</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->display_name }}</td>
                                <td>{{ $role->description }}</td>
                                @php( $permRole = [])
                                <td>@foreach ($role->perms as $perm)
                                        <span class="badge label-primary">{{ $perm->display_name }} </span>
                                    @endforeach</td>
                                <td>
                                    @if(Entrust::can('update-role-perms'))
                                    <button id="perms_btn" class="btn btn-primary" data-toggle="modal"
                                            data-target="#perms_modal" data-id="{{ $role->id }}"
                                            data-perms="@foreach ($role->perms as $perm){{ $perm->id }} @endforeach">
                                        Perms
                                    </button>
                                   @endif
                                        @if(Entrust::can('update-role'))
                                        <button id="edit_btn" class="btn btn-primary" data-toggle="modal"
                                            data-target="#edit_modal" data-id="{{ $role->id }}" data-name="{{ $role->name }}"
                                            data-display_name="{{ $role->display_name }}" data-description="{{ $role->description }}" >
                                        Edit
                                    </button>
                                  @endif
                                        @if(Entrust::can('delete-role'))
                                            <form action="{{ URL::to('roles/destroy') }}/{{ $role->id }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="submit" class="btn btn-primary" value="delete">
                                    </form>
                                @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Role</th>
                            <th>Role Description</th>
                            <th>Permissions</th>
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
        <div class="modal fade" id="store_modal" tabindex="-1" role="dialog" aria-labelledby="storeModal">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="storeModalLabel">New role</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" id="store_form" action="{{URL::to('roles/store')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label" for="role_name">Role name</label>
                                <input type="text" name="name" id="role_name" placeholder="Role name"
                                       class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="display_name">Display name</label>
                                <input type="text" name="display_name" id="display_name" placeholder="Display name"
                                       class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="description">Description</label>
                                <input type="text" name="description" id="description" placeholder="Description"
                                       class="form-control"/>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <input type="submit" form="store_form" class="btn btn-md btn-info"
                               value="Submit">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="editModal">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="editModalLabel">Update role</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" id="edit_form"  method="post">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PUT">
                            <div class="form-group">
                                <label class="control-label" for="erole_name">Role name</label>
                                <input type="text" name="name" id="erole_name" placeholder="Role name"
                                       class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="edisplay_name">Display name</label>
                                <input type="text" name="display_name" id="edisplay_name" placeholder="Display name"
                                       class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="edescription">Description</label>
                                <input type="text" name="description" id="edescription" placeholder="Description"
                                       class="form-control"/>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <input type="submit" form="edit_form" class="btn btn-md btn-info"
                               value="Submit">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="perms_modal" tabindex="-1" role="dialog" aria-labelledby="permsModal">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="permsModalLabel">Update role</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" id="perms_form"  method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label" for="perms">Permeation name</label>
                                <select id="perms" class="form-control" name="perms[]"
                                        multiple="multiple">

                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <input type="submit" form="perms_form" class="btn btn-md btn-info"
                               value="Submit">
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
        $(document).ready(function () {
            $('#rols_table').DataTable();
            $("#perms").select2({
                placeholder: "Select a role",
                width: '100%'
            });
            $(document).on("click", "#edit_btn", function () {
                var id = $(this).data('id');
                var name= $(this).data('name');
                var display_name= $(this).data('display_name');
                var description= $(this).data('description');
                $('#edit_form').attr('action', '{{URL::to('roles/update')}}/' + id);
                $('#erole_name').val(name);
                $('#edisplay_name').val(display_name);
                $('#edescription').val(description);
            });

            $(document).on("click", "#perms_btn", function () {
                var perms = $(this).data('perms');
                var permsArray = perms.split(" ").slice(0, -1);
                var roleId = $(this).data('id');
                $("#perms_form").attr("action", "{{ URL::to('roles/updatePerms') }}/" + roleId);
                @foreach($perms as $perm)
                if ($.inArray('{{ $perm->id }}', permsArray) != -1) {
                    $("#perms").append('<option value="{{ $perm->id }}" selected>{{ $perm->display_name }}</option>');
                } else {
                    $("#perms").append('<option value="{{ $perm->id }}">{{ $perm->display_name }}</option>');

                }
                @endforeach

            });


        });
    </script>

@endsection
