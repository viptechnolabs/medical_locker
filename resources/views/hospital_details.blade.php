@extends('layout.app')
@section('content')

    <div>
        <a href="{{route('index')}}"> Do your work, then step back. </a>
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Hospital Details</h3>
                </div>

                <div class="title_right">

                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Hospital Report & All Activity</h2>
                            {{--                            <ul class="nav navbar-right panel_toolbox">--}}
                            {{--                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>--}}
                            {{--                                </li>--}}
                            {{--                                <li class="dropdown">--}}
                            {{--                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"--}}
                            {{--                                       aria-expanded="false"><i class="fa fa-wrench"></i></a>--}}
                            {{--                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
                            {{--                                        <a class="dropdown-item" href="#">Settings 1</a>--}}
                            {{--                                        <a class="dropdown-item" href="#">Settings 2</a>--}}
                            {{--                                    </div>--}}
                            {{--                                </li>--}}
                            {{--                                <li><a class="close-link"><i class="fa fa-close"></i></a>--}}
                            {{--                                </li>--}}
                            {{--                            </ul>--}}
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-3 col-sm-3  profile_left">
                                <div class="profile_img">
                                    <div id="crop-avatar">
                                        <!-- Current avatar -->
                                        <img class="img-responsive avatar-view"
                                             src="{{asset('upload_file/'.$hospital[0]->logo)}}" alt="Hospital Logo"
                                             title="Change the avatar" style="height: 220px; width: 220px">
                                    </div>
                                </div>
                                <h3>{{$hospital[0]->name}}</h3>
                                <hr>

                                <ul class="list-unstyled user_data" style="font-size: 19px">
                                    <li><i class="fa fa-map-marker user-profile-icon"></i> {{$hospital[0]->address}}
                                    </li>

                                    <li>
                                        <i class="fa fa-briefcase user-profile-icon"></i> {{$hospital[0]->details}}
                                    </li>

                                    <li>
                                        <a href="mailto:{{$hospital[0]->email}}">
                                            <i class="fa fa-envelope user-profile-icon"></i> {{$hospital[0]->email}}
                                        </a>
                                    </li>

                                    <li>
                                        <i class="fa fa-phone-square user-profile-icon"></i> {{$hospital[0]->mobile_no}}
                                    </li>
                                </ul>


                            </div>
                            <div class="col-md-9 col-sm-9 ">

                                <div class="profile_title">
                                    <div class="col-md-9">
                                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#edit_hospital_details"
                                                                                      id="home-tab"
                                                                                      role="tab" data-toggle="tab"
                                                                                      aria-expanded="true">Edit</a>
                                            </li>
                                            <li role="presentation" class=""><a href="#total_patient_count" role="tab"
                                                                                id="profile-tab" data-toggle="tab"
                                                                                aria-expanded="false">Total Patient
                                                    Count</a>
                                            </li>
                                            <li role="presentation" class=""><a href="#doctor_patient_count" role="tab"
                                                                                id="profile-tab" data-toggle="tab"
                                                                                aria-expanded="false">Doctor & Patient
                                                    Count</a>
                                            </li>
                                            <li role="presentation" class=""><a href="#edit" role="tab"
                                                                                id="profile-tab2"
                                                                                data-toggle="tab"
                                                                                aria-expanded="false">Recent
                                                    Activity</a>
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
                                        <!-- start hospital details update -->
                                        <div role="tabpanel" class="tab-pane active " id="edit_hospital_details"
                                             aria-labelledby="home-tab">

                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h2>Hospital Details Update</h2>

                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content">
                                                    <br/>
                                                    <form action="{{route('hospital_details_update')}}"
                                                          class="form-horizontal form-label-left" method="post"
                                                          enctype="multipart/form-data" id="hospital_details_update">
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
                                                        <div class="form-group row ">
                                                            <label class="control-label col-md-3 col-sm-3 ">Name</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input type="text" class="form-control"
                                                                       name="hospital_name"
                                                                       value="{{$hospital[0]->name}}"
                                                                       placeholder="Hospital Name">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="control-label col-md-3 col-sm-3 "> Details
                                                            </label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                            <textarea class="form-control" rows="3"
                                                                      name="hospital_details"
                                                                      placeholder="{{$hospital[0]->details}}">{{$hospital[0]->details}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="control-label col-md-3 col-sm-3 ">Register
                                                                No</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input type="text" class="form-control"
                                                                       disabled="disabled" name="hospital_registerno"
                                                                       value="{{$hospital[0]->register_no}}"
                                                                       placeholder="Register No">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Email</label>
                                                            <div class="col-md-7 col-sm-3 ">
                                                                <input type="email" class="form-control"
                                                                       value="{{$hospital[0]->email}}"
                                                                       placeholder="Email"
                                                                       readonly="readonly">
                                                            </div>

                                                            <a class="border-button" href="javascript:;"
                                                               onclick="getEmailPopup('{{ route('email.popup.get', $hospital[0]->id) }}', '{{ route('check.email') }}', {{ $hospital[0]->id }})">
                                                                <button type="button" class="btn btn-secondary">
                                                                    Change Email
                                                                </button>
                                                            </a>

                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="control-label col-md-3 col-sm-3 ">Mobile
                                                                No</label>
                                                            <div class="col-md-6 col-sm-3 ">
                                                                <input type="text" class="form-control"
                                                                       value="{{$hospital[0]->mobile_no}}"
                                                                       placeholder="Mobile No" readonly="readonly"
                                                                       name="mobile_no"
                                                                >
                                                            </div>

                                                            <a class="border-button" href="javascript:;"
                                                               onclick="getMobilePopup('{{ route('mobile.popup.get', $hospital[0]->id) }}', '{{ route('check.mobile') }}', {{ $hospital[0]->id }})">
                                                                <button type="button" class="btn btn-secondary">
                                                                    Change Mobile No
                                                                </button>
                                                            </a>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="control-label col-md-3 col-sm-3 ">Fex
                                                                No</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input type="text" class="form-control"
                                                                       value="{{$hospital[0]->fex_no}}"
                                                                       placeholder="Fex No" name="hospital_fex_no">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="control-label col-md-3 col-sm-3 ">Pin Cord
                                                                No</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input type="text" class="form-control"
                                                                       value="{{$hospital[0]->pin_cord_no}}"
                                                                       placeholder="Pin Cord No"
                                                                       name="hospital_pin_cord_no">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="control-label col-md-3 col-sm-3 "> Address
                                                            </label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                            <textarea class="form-control" rows="3"
                                                                      name="hospital_address"
                                                                      placeholder="Address">{{$hospital[0]->address}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Password</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <a href="routes"></a>
                                                                <button type="button" class="btn btn-sm btn-secondary"
                                                                        data-toggle="modal"
                                                                        data-target="#change_password">
                                                                    Change Password
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="control-label col-md-3 col-sm-3 ">Hospital
                                                                Logo</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input type="file" value="" name="hospital_logo"
                                                                       accept="image/*">
                                                            </div>
                                                        </div>

                                                        <div class="ln_solid"></div>
                                                        <div class="form-group">
                                                            <div class="col-md-9 col-sm-9  offset-md-3">
                                                                <a href="{{route('index')}}">
                                                                    <button type="button" class="btn btn-primary">Cancel
                                                                    </button>
                                                                </a>
                                                                <button type="reset" class="btn btn-primary">Reset
                                                                </button>
                                                                <button class="btn btn-success">Submit
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <x-change-password/>
                                            <!-- Change E-mails Pop-Up -->
                                            <div id="update_email_popup"></div>
                                            <!-- /Change E-mails Pop-Up -->
                                            <!-- Change Mobile Pop-Up -->
                                            <div id="update_mobile_popup"></div>
                                            <!-- /Change Mobile Pop-Up -->
                                        </div>
                                        <!-- end hospital details update -->
                                        <!-- start patient count -->
                                        <div role="tabpanel" class="tab-pane fade" id="total_patient_count"
                                             aria-labelledby="profile-tab">
                                            <table class="data table table-striped no-margin">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Mouth & Year</th>
                                                    <th>New Patient</th>
                                                    <th>Old Patient</th>
                                                    <th>Totle Patient</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end patient count -->
                                        <!-- start doctor and patient count -->
                                        <div role="tabpanel" class="tab-pane fade" id="doctor_patient_count"
                                             aria-labelledby="profile-tab">
                                            <table class="data table table-striped no-margin">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Doctor Name</th>
                                                    <th>Mouth & Year</th>
                                                    <th>New Patient</th>
                                                    <th>Old Patient</th>
                                                    <th>Totle Patient</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end doctor and  patient count -->
                                        <!-- start recent activity -->
                                        <div role="tabpanel" class="tab-pane fade" id="edit"
                                             aria-labelledby="profile-tab">

                                        </div>
                                        <!-- end recent activity -->
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


