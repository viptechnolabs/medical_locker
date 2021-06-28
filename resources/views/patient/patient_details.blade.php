@extends('layout.app')
@section('content')
    <div>
        <a href="{{route(Session::get('userType') === "user" ? "index" : "patient.index")}}"> Do your work, then step
            back. </a>
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Update Details</h3>
                </div>

                <div class="title_right">

                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Patient Update Details</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <a type='button' class='btn btn-success btn-sm' href="{{route('patient.add_report', $patient->id)}}"><i class='fa fa-plus'> </i> Add Report</a>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-3 col-sm-3  profile_left">
                                <div class="profile_img">
                                    <div id="crop-avatar">
                                        <!-- Current avatar -->
                                        <img class="img-responsive avatar-view"
                                             src="{{$patient->profile_photo ? asset('upload_file/patient/'.$patient->profile_photo) : asset('upload_file/default.png')}}"
                                             alt="{{$patient->name}}"
                                             title="Change the avatar" style="height: 220px; width: 220px">
                                    </div>
                                </div>
                                <h3>{{$patient->name}}</h3>
                                <hr>

                                <ul class="list-unstyled user_data" style="font-size: 19px">
                                    <li>
                                        <a href="mailto:{{$patient->email}}">
                                            <i class="fa fa-envelope user-profile-icon"></i> {{$patient->email}}
                                        </a>
                                    </li>

                                    <li>
                                        <i class="fa fa-phone-square user-profile-icon"></i> {{$patient->mobile_no}}
                                    </li>
                                    <li><i class="fa fa-map-marker user-profile-icon"></i> {{$patient->address}}
                                    </li>


                                </ul>


                            </div>
                            <div class="col-md-9 col-sm-9 ">

                                <div class="profile_title">
                                    <div class="col-md-9">
                                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#edit_patient_details"
                                                                                      id="home-tab"
                                                                                      role="tab" data-toggle="tab"
                                                                                      aria-expanded="true">Edit Patient</a>
                                            </li>
                                            <li role="presentation" class=""><a href="#patient_report" role="tab"
                                                                                id="profile-tab" data-toggle="tab"
                                                                                aria-expanded="false">Patient
                                                    Report</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-3">
                                        <div id="reportrange" class="pull-right"
                                             style="margin-top: 5px; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED">
                                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                            <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                                        </div>
                                    </div>
                                </div>
                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                    <div id="myTabContent" class="tab-content">
                                        <!-- start patient details update -->
                                        <div role="tabpanel" class="tab-pane active " id="edit_patient_details"
                                             aria-labelledby="home-tab">

                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h2>Patient Details Update</h2>

                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content">
                                                    <br/>
                                                    <form action="{{ route('patient.patient_details_update')}}"
                                                          class="form-horizontal form-label-left" method="post"
                                                          enctype="multipart/form-data" id="patient_details_update">

                                                        @method('put')
                                                        @csrf


                                                        @if ($errors->any())
                                                            @foreach ($errors->all() as $message)
                                                                <div class="alert alert-danger alert-dismissible "
                                                                     role="alert">
                                                                    <button type="button" class="close"
                                                                            data-dismiss="alert" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                    <strong>{{ $message }}</strong>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                        @if (session()->has('message'))
                                                            <div class="alert alert-success alert-dismissible "
                                                                 role="alert">
                                                                <button type="button" class="close"
                                                                        data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                                <strong>{{ session('message') }}</strong>
                                                            </div>
                                                        @endif
                                                        <input type="hidden" class="form-control" name="id"
                                                               value="{{$patient->id}}">
                                                        <div class="form-group row ">
                                                            <label class="control-label col-md-3 col-sm-3 ">Name</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input type="text" class="form-control"
                                                                       name="name"
                                                                       value="{{$patient->name}}"
                                                                       placeholder="patient Name" {{Session::get('userType') === "user" ? "readonly" : ""}}>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Email</label>
                                                            <div
                                                                class="{{Session::get('userType') === "user" ? "col-md-7 col-sm-3" : "col-md-9 col-sm-9"}}">
                                                                <input type="email" class="form-control"
                                                                       value="{{$patient->email}}"
                                                                       placeholder="Email"
                                                                       name="email" {{Session::get('userType') === "user" ? "readonly" : ""}}>
                                                            </div>
                                                            @if(Session::get('userType') === "user" )
                                                                <a class="border-button" href="javascript:;"
                                                                   onclick="getEmailPopup('{{ route('email.popup.get', $patient->id) }}', '{{ route('check.email') }}', {{ $patient->id }}, '{{ Session::get('userType') }}')">
                                                                    <button type="button" class="btn btn-secondary">
                                                                        Change Email
                                                                    </button>
                                                                </a>
                                                            @endif

                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Mobile
                                                                No</label>
                                                            <div
                                                                class="{{Session::get('userType') === "user" ? "col-md-6 col-sm-3" : "col-md-9 col-sm-9"}}">
                                                                <input type="text" class="form-control"
                                                                       value="{{$patient->mobile_no}}"
                                                                       placeholder="Mobile No"
                                                                       name="mobile_no" {{Session::get('userType') === "user" ? "readonly" : ""}}>
                                                            </div>
                                                            @if(Session::get('userType') === "user" )
                                                                <a class="border-button" href="javascript:;"
                                                                   onclick="getMobilePopup('{{ route('mobile.popup.get', $patient->id) }}', '{{ route('check.mobile') }}', {{ $patient->id }}, '{{ Session::get('userType') }}')">
                                                                    <button type="button" class="btn btn-secondary">
                                                                        Change Mobile No
                                                                    </button>
                                                                </a>
                                                            @endif

                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="control-label col-md-3 col-sm-3 "> Address
                                                            </label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                            <textarea class="form-control" rows="3"
                                                                      name="address"
                                                                      placeholder="Address">{{$patient->address}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">State</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <select id="state" name="state" class="form-control">
                                                                    <option value="">Choose..</option>
                                                                    @foreach($states as $state)
                                                                        <option
                                                                            value="{{$state->name}}" {{ ($patient->state === $state->name) ? "selected" : "" }}>{{$state->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">City</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <select id="city" name="city" class="form-control">
                                                                    <option value="">Choose..</option>
                                                                    @foreach($cities as $city)
                                                                        <option
                                                                            value="{{$city->name}}" {{ ($patient->city === $city->name) ? "selected" : "" }}>{{$city->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Pin
                                                                Code</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input type="text" class="form-control"
                                                                       value="{{$patient->pin_code}}"
                                                                       placeholder="Pin Code" name="pin_code">
                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Aadhar
                                                                No</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input type="text" class="form-control"
                                                                       value="{{$patient->aadhar_no}}"
                                                                       placeholder="Aadhar No"
                                                                       name="aadhar_no" {{Session::get('userType') === "user" ? "readonly" : ""}}>
                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Date Of
                                                                Birth</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input id="dob" name="dob" value="{{$patient->dob}}"
                                                                       class="date-picker form-control"
                                                                       placeholder="dd-mm-yyyy" type="text"
                                                                       onfocus="this.type='date'"
                                                                       onmouseover="this.type='date'"
                                                                       onclick="this.type='date'"
                                                                       onblur="this.type='text'"
                                                                       onmouseout="timeFunctionLong(this)">
                                                                <script>
                                                                    function timeFunctionLong(input) {
                                                                        setTimeout(function () {
                                                                            input.type = 'text';
                                                                        }, 60000);
                                                                    }
                                                                </script>
                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Profile
                                                                Photo</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input type="file" id="profile_photo"
                                                                       name="profile_photo" accept="image/*">
                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Document
                                                                Photo</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <div class="col-md-55">
                                                                    <div class="thumbnail">
                                                                        <div class="image view view-first">
                                                                            <a href="{{asset('upload_file/patient/patient_document/'.$patient->document_photo)}}"
                                                                               target="_blank">
                                                                                <img
                                                                                    style="width: 100%; display: block;"
                                                                                    src="{{$patient->document_photo ? asset('upload_file/patient/patient_document/'.$patient->document_photo) : asset('upload_file/default.png')}}"
                                                                                    alt="{{$patient->name}}">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if(Session::get('userType') !== "user" )
                                                                    <input type="file" id="document_photo"
                                                                           name="document_photo" accept="image/*"
                                                                           alt="{{$patient->name}}">
                                                                @endif
                                                            </div>

                                                        </div>
                                                        <div class="ln_solid"></div>
                                                        <div class="form-group">
                                                            <div class="col-md-9 col-sm-9  offset-md-3">
                                                                <a href="{{route('patient.index')}}">
                                                                    <button type="button" class="btn btn-primary">Cancel
                                                                    </button>
                                                                </a>
                                                                <button type="reset" class="btn btn-primary">Reset
                                                                </button>
{{--                                                                @if(Session::get('userType') !== "patient" )--}}
{{--                                                                    <a href="{{route('patient.patient_delete', $patient->id)}}">--}}
{{--                                                                        <button type="button" class="btn btn-danger">--}}
{{--                                                                            Delete--}}
{{--                                                                        </button>--}}
{{--                                                                    </a>--}}
{{--                                                                @endif--}}
                                                                <button class="btn btn-success">Submit
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- Change E-mails Pop-Up -->
{{--                                            <div id="update_email_popup"></div>--}}
                                            <!-- /Change E-mails Pop-Up -->
                                            <!-- Change Mobile Pop-Up -->
{{--                                            <div id="update_mobile_popup"></div>--}}
                                            <!-- /Change Mobile Pop-Up -->
                                        </div>
                                        <!-- end patient details update -->
                                        <!-- start patient count -->
                                        <div role="tabpanel" class="tab-pane fade" id="patient_report"
                                             aria-labelledby="profile-tab">
                                            <table class="data table table-striped no-margin">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Consultant Date</th>
                                                    <th>Type</th>
                                                    <th>Treatment Name</th>
                                                    <th>Consultant Doctor</th>
                                                    <th>Routine Checkup</th>
                                                    <th>Insurance</th>
                                                    <th>File (Reports)</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($reports as $report)
                                                    <tr>
                                                        <td></td>

                                                        <td>{{$report->consultant_date}}</td>

                                                        <td>{{$report->type}}</td>

                                                        <td>{{$report->treatment_name}}</td>

                                                        <td>{{$report->doctor[0]->name}}</td>
{{--                                                        <td>{{$report->doctor}}</td>--}}

                                                        <td>{{$report->routine_checkup}}</td>

                                                        <td>{{$report->insurance}}</td>

                                                        <td></td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end patient count -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


