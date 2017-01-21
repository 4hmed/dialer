@extends('layouts.app')

@section('styles')
    <link href="{{ asset('vendor/dataTables/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datetimepicker/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/intltelinput/css/intlTelInput.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/intltelinput/css/demo.css')}}" type="text/css">
    <link href="{{asset('vendor/select2/css/select2.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('vendor/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>

@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">User Profile |
                <small>Account Settings</small>
            </h2>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif  </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Profile Picture
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="user">
                        <div class="text-center">
                            <img id="profile_pic" src="{{ asset('uploads/images').'/'.$user->image }}"
                                 class="img-rounded img-thumbnail img-responsive" style="width: 100%; height: 100%;">
                        </div>
                        <form role="form" method="post" action="{{ URL::to('account/updateImage').'/'.$user->id }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PUT">
                            <input type='file' name="image" id="pic_input"/>
                            <input type="submit" value="submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Profile Details
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#info" data-toggle="tab">Personal Info</a>
                        </li>
                        <li><a href="#password" data-toggle="tab">Change Password</a>
                        </li>
                        <li><a href="#contacts" data-toggle="tab">Contacts</a>
                        </li>
                        <li><a href="#groups" data-toggle="tab">Groups</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="info">
                            <h4>Home Tab</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <form role="form" id="details"
                                          action="{{URL::to('account/updateDetails').'/'.$user->id}}"
                                          method="post">
                                        {{ csrf_field() }}
                                        <input name="_method" type="hidden" value="PUT">

                                        <div class="form-group">
                                            <label class="control-label">Name</label>
                                            <input type="text" placeholder="John" name="name"
                                                   value="{{ $user->name }}"
                                                   class="form-control"/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">E-mail</label>
                                            <input type="email" name="email"
                                                   placeholder="John@email.com"
                                                   value="{{ $user->email }}" class="form-control"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="mobile" class="control-label">mobile</label>
                                            <div><input id="mobile" class="form-control mmobile"
                                                        value="{{$user->code.$user->mobile }}"
                                                        name="mobile" type="tel">
                                                <input id="country_code" class="form-control" name="country_code"
                                                       type="hidden">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="dtp_input2" class="control-label">Birth Date</label>
                                            <div class="input-group date form_date" data-date=""
                                                 data-date-format="yyyy-mm-dd" data-link-field="dtp_input2"
                                                 data-link-format="yyyy-mm-dd">
                                                <input class="form-control" size="16" name="birth_date" value="{{ $user->dob }}" type="text" readonly>
                                                <span class="input-group-addon"><span
                                                            class="glyphicon glyphicon-remove"></span></span>
                                                <span class="input-group-addon"><span
                                                            class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                            <input type="hidden" id="dtp_input2" value=""/><br/>
                                        </div>

                                        <input type="submit" class="btn btn-primary" value="Save Changes"/>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="password">
                            <div class="row">
                                <div class="col-md-12">
                                    <form role="form" id="password_form"
                                          action="{{URL::to('account/updatePassword').'/'.$user->id}}" method="post">
                                        {{ csrf_field() }}
                                        <input name="_method" type="hidden" value="PUT">
                                        <div class="form-group">
                                            <label class="control-label">Current Password</label>
                                            <input type="password" name="current_password"
                                                   class="form-control"/></div>
                                        <div class="form-group">
                                            <label class="control-label">New Password</label>
                                            <input type="password" name="password" class="form-control"/></div>
                                        <div class="form-group">
                                            <label class="control-label">Re-type New Password</label>
                                            <input type="password" name="password_confirmation"
                                                   class="form-control"/></div>
                                        <div class="margin-top-10">
                                            <input type="submit" value="Change Password" class="btn green">
                                            <a href="javascript:;" class="btn default"> Cancel </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contacts">
                            <h4>Messages Tab</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ URL::to('contact') }}" class="btn btn-primary">New Contact</a>
                                    <table class="table table-striped table-bordered table-hover" id="contacts_table">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Groups</th>
                                            <th>Options</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($user->contacts as $contact)
                                            <tr>
                                                <td>{{ $contact->name }}</td>
                                                <td>@foreach($contact->phones as $index => $value) @if($index == 0){{ $value->phone }} @endif @endforeach</td>
                                                <td>@foreach($contact->groups as $group)<span
                                                            class="badge label-primary">{{ $group->name }}</span> @endforeach
                                                </td>
                                                <td>
                                                    <a href="{{ URL::to('contact').'/'.$contact->id}}" class="btn btn-primary">Edit</a>
                                                    <button id="contact_groups_btn" class="btn btn-primary" data-toggle="modal"
                                                            data-target="#contact_groups_modal" data-id="{{ $contact->id }}"
                                                            data-groups="@foreach ($contact->groups as $groups){{ $groups->id }} @endforeach">
                                                        groups
                                                    </button>
                                                    <form action="{{ URL::to('contact/destroy') .'/'. $contact->id }}" method="post">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="submit" class="btn btn-primary" value="delete">
                                                    </form>

                                                </td>
                                            </tr>
                                        @endforeach


                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Groups</th>
                                            <th>Options</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="groups">
                            <h4>Settings Tab</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <button id="new_group_btn" class="btn btn-primary" data-toggle="modal"
                                            data-target="#new_group_modal">
                                        New Group
                                    </button>
                                    <table class="table table-striped table-bordered table-hover" id="groups_table">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>No. of Contacts</th>
                                            <th>Options</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($user->groups as $group)
                                            <tr>
                                                <td>{{ $group->name }}</td>
                                                <td>
                                                    <span class="badge label-primary">{{ count($group->contacts) }}</span>
                                                </td>
                                                <td>
                                                    <button id="edit_group_btn" class="btn btn-primary"
                                                            data-toggle="modal"
                                                            data-target="#edit_group_modal" data-id="{{ $group->id }}"
                                                            data-name="{{ $group->name }}">
                                                        Edit
                                                    </button>
                                                    <form action="{{ URL::to('group/destroy') .'/'. $group->id }}" method="post">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="submit" class="btn btn-primary" value="delete">
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach


                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>No. of Contacts</th>
                                            <th>Options</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <div class="modal fade" id="new_group_modal" tabindex="-1" role="dialog"
             aria-labelledby="newGroupModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLabel">New Group</h4>
                    </div>
                    <div class="modal-body">
                        <form id="new_group_form" class="form-horizontal" action="{{URL::to('group/store').'/'.$user->id}}" method="post">
                            {{ csrf_field() }}
                            <label for="group" class="control-label">Group</label>
                            <input type="text" id="new_group_name" class="form-control" name="name">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Close
                        </button>
                        <input type="submit" form="new_group_form" class="btn btn-default" value="Submit">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="contact_groups_modal" tabindex="-1" role="dialog"
             aria-labelledby="groupsModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLabel">New Group</h4>
                    </div>
                    <div class="modal-body">
                        <form id="contact_groups_form" class="form-horizontal" method="post">
                            {{ csrf_field() }}
                            <label for="contact_groups_input" class="control-label">Group</label>
                            <select id="contact_groups_input" class="form-control" name="groups[]"
                                    multiple="multiple">

                            </select>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Close
                        </button>
                        <input type="submit" form="contact_groups_form" class="btn btn-default" value="Submit">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="edit_group_modal" tabindex="-1" role="dialog"
             aria-labelledby="editGroupModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLabel">Edit Group</h4>
                    </div>
                    <div class="modal-body">
                        <form id="edit_group_form" class="form-horizontal" method="post">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PUT">
                            <label for="edit_group_input" class="control-label">Group</label>
                            <input type="text" id="egroup" class="form-control" name="name">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Close
                        </button>
                        <input type="submit" form="edit_group_form" class="btn btn-default" value="Save Changes">
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.row -->
@endsection
@section('scripts')
    <script src="{{ asset('vendor/dataTables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/dataTables/js/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datetimepicker/js/bootstrap-datetimepicker.js') }}"
            charset="UTF-8"></script>
    <script src="{{ asset('vendor/intltelinput/js/intlTelInput.js') }}"></script>
    <script src="{{asset('vendor/select2/js/select2.full.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('#contacts_table').DataTable();
            $('#groups_table').DataTable();

            $("#contact_groups_input").select2({
                placeholder: "Select a Group",
                width: '100%'
            });

            $('.form_date').datetimepicker({
                weekStart: 1,
                todayBtn: 1,
                pickerPosition: 'top-left',
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0
            });

            $('#mobile').intlTelInput({
                autoHideDialCode: false,
                autoPlaceholder: "on",
                dropdownContainer: "body",
                formatOnDisplay: true,
                geoIpLookup: function (callback) {
                    $.get("http://ipinfo.io", function () {
                    }, "jsonp").always(function (resp) {
                        var countryCode = (resp && resp.country) ? resp.country : "";
                        callback(countryCode);
                    });
                },
                nationalMode: true,
                placeholderNumberType: "MOBILE",
                preferredCountries: [],
                separateDialCode: true
            });
            $(function () {
                $('#country_code').val($('.selected-dial-code').text());
            });
            $('#mobile').on('select', function () {

                $('#country_code').val($(this).parent().find('.selected-dial-code').text());
            });
            $("#pic_input").change(function () {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#profile_pic').attr('src', e.target.result);
                    };

                    reader.readAsDataURL(this.files[0]);
                }
            });

            $(document).on("click", "#contact_groups_btn", function () {
                var str = $(this).data('groups');
                var contactId = $(this).data('id');
                $("#contact_groups_form").attr("action", "{{ URL::to('contact/updateGroups') }}/" + contactId);
                var arr = str.split(" ").slice(0, -1);
                @foreach($user->groups as $group)
                if ($.inArray('{{ $group->id }}', arr) != -1) {
                    $("#contact_groups_input").append('<option value="{{ $group->id }}" selected>{{ $group->name }}</option>');
                } else {
                    $("#contact_groups_input").append('<option value="{{ $group->id }}">{{ $group->name }}</option>');

                }
                @endforeach

            });

            $(document).on("click", "#edit_group_btn", function () {
                var str = $(this).data('name');
                var groupId = $(this).data('id');
                $("#edit_group_input").val(str);
                $("#edit_group_form").attr("action", "{{ URL::to('group/update')}}/" + groupId);

            });

        });
    </script>
@endsection
