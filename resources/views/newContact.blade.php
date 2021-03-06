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
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Profile Details
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- Nav tabs -->

                    <!-- Tab panes -->
                    <form role="form" id="details"
                          enctype="multipart/form-data" action="{{URL::to('contact/store')}}"
                          method="post">
                        {{ csrf_field() }}
                        <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Profile Picture
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="user">
                                    <div class="text-center">
                                        <img id="profile_pic" src=""
                                             class="img-rounded img-thumbnail img-responsive"
                                             style="width: 100%; height: 100%;">
                                    </div>
                                    <input type='file' name="image" id="pic_input"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">


                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <input type="text" placeholder="John" name="name"
                                       class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">E-mail</label>
                                <input type="email" name="email"
                                       placeholder="John@email.com" class="form-control"/>
                            </div>
                            <div id="div_phone" class="form-group">
                                <label for="phone" class="control-label">phone</label>
                                <div>
                                    <input id="phone" class="form-control"
                                           name="phones[]" type="tel">
                                </div>
                                <div id="new">
                                </div>
                                <input id="country_code" class="form-control" name="codes[]"
                                       type="hidden">
                            </div>
                            <button type="button" class="btn btn-success" id="add_phone">More Phone
                            </button>
                            <div class="form-group">
                                <label for="dtp_input2" class="control-label">Birth Date</label>
                                <div class="input-group date form_date" data-date=""
                                     data-date-format="yyyy-mm-dd" data-link-field="dtp_input2"
                                     data-link-format="yyyy-mm-dd">
                                    <input class="form-control" size="16" name="birth_date" type="text" readonly>
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
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
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

            $('#add_phone').click(function () {
                var clone = $("#div_phone").clone();
                var newdiv = clone.find('#new');
                clone.find('#phone').clone().attr('id', 'newid').prependTo(newdiv);
                newdiv.removeAttr('id').append('<i class="fa fa-times-circle-o fa-2x text-danger" id="cancel_phone"></i>');
                clone.find('#phone').parent().parent().remove();
                clone.find('#newid').attr('id', 'phone').intlTelInput({
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


                clone.insertBefore('#add_phone').css({'display': "block"});
                clone.find('#phone').on('select', function () {
                    var x = clone.find('.selected-dial-code').text();
                    $(this).parent().parent().parent().find('#country_code').val(x);
                });
                clone.find('#cancel_phone').on('click', function () {
                    $(this).parent().parent().remove();

                });

            });

            $(function () {
                $('#country_code').val($('.selected-dial-code').text());
            });
            $('#phone').on('select', function () {

                $(this).parent().parent().parent().find('#country_code').val($(this).parent().find('.selected-dial-code').text());
            });


            $('#phone').intlTelInput({
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


        });
    </script>
@endsection
