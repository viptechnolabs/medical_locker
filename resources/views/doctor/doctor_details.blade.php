@extends('layout.app')
@section('content')

    <div>
        <a href="{{route('doctor.index')}}"> Do your work, then step back. </a>
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Doctor Details</h3>
                </div>

                <div class="title_right">

                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Doctor Details & All Activity</h2>
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
                                             src="{{asset('upload_file/doctor/'.$doctor->profile_photo)}}" alt="{{$doctor->name}}"
                                             title="Change the avatar" style="height: 220px; width: 220px">
                                    </div>
                                </div>
                                <h3>Dr.{{$doctor->name}}</h3>
                                <hr>

                                <ul class="list-unstyled user_data" style="font-size: 19px">
                                    <li>
                                        <i class="fa fa-briefcase user-profile-icon"></i>

                                        @foreach ($doctor->certificate as $certificate){{$certificate->degree_name}},

                                    @endforeach
                                    </li>
                                    <li>
                                        <a href="mailto:{{$doctor->email}}">
                                            <i class="fa fa-envelope user-profile-icon"></i> {{$doctor->email}}
                                        </a>
                                    </li>

                                    <li>
                                        <i class="fa fa-phone-square user-profile-icon"></i> {{$doctor->mobile_no}}
                                    </li>
                                    <li><i class="fa fa-map-marker user-profile-icon"></i> {{$doctor->address}}
                                    </li>


                                </ul>


                            </div>
                            <div class="col-md-9 col-sm-9 ">

                                <div class="profile_title">
                                    <div class="col-md-9">
                                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#edit_doctor_details"
                                                                                      id="home-tab"
                                                                                      role="tab" data-toggle="tab"
                                                                                      aria-expanded="true">Edit Doctor</a>
                                            </li>
                                            <li role="presentation" class=""><a href="#patient_count" role="tab"
                                                                                id="profile-tab" data-toggle="tab"
                                                                                aria-expanded="false">Patient
                                                    Count</a>
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
                                        <!-- start doctor details update -->
                                        <div role="tabpanel" class="tab-pane active " id="edit_doctor_details"
                                             aria-labelledby="home-tab">

                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h2>Doctor Details Update</h2>

                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content">
                                                    <br/>
                                                    <form action="{{route('doctor.doctor_details_update')}}"
                                                          class="form-horizontal form-label-left" method="post"
                                                          enctype="multipart/form-data" id="doctor_details_update">
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
                                                        <input type="hidden" class="form-control" name="id" value="{{$doctor->id}}">
                                                        <div class="form-group row ">
                                                            <label class="control-label col-md-3 col-sm-3 ">Name</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input type="text" class="form-control"
                                                                       name="name"
                                                                       value="{{$doctor->name}}"
                                                                       placeholder="Doctor Name">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Degree</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <table class="table " id="dynamicAddRemove">
                                                                    <tr>
                                                                        <td><input type="text" id="update_degree" name="degree[0]" placeholder="Enter Degree" class="form-control" /></td>
                                                                        <td><input  type="file" id="update_certificates"  name="certificates[0]" accept="image/*" /></td>
                                                                        <td><button type="button" name="add" id="add-btn" class="btn btn-sm btn-success">Add More</button></td>
                                                                    </tr>
                                                                </table>
                                                            </div>

                                                        </div>
                                                        <div class="form-group row ">
                                                            <label class="control-label col-md-3 col-sm-3 ">Specialist</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input type="text" class="form-control"
                                                                       name="specialist"
                                                                       value="{{$doctor->specialist}}"
                                                                       placeholder="Specialist">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Email</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input type="email" class="form-control"
                                                                       value="{{$doctor->email}}"
                                                                       placeholder="Email" name="email">
                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Mobile No</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input type="text" class="form-control"
                                                                       value="{{$doctor->mobile_no}}"
                                                                       placeholder="Mobile No" name="mobile_no">
                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="control-label col-md-3 col-sm-3 "> Address
                                                            </label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                            <textarea class="form-control" rows="3"
                                                                      name="address"
                                                                      placeholder="Address">{{$doctor->address}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">State</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <select id="state" name="state" class="form-control" >
                                                                    <option value="">Choose..</option>
                                                                    @foreach($states as $state)
                                                                        <option value="{{$state->name}}" {{ ($doctor->state === $state->name) ? "selected" : "" }}>{{$state->name}}</option>
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
                                                                        <option value="{{$city->name}}" {{ ($doctor->city === $city->name) ? "selected" : "" }}>{{$city->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Pin Code</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input type="text" class="form-control"
                                                                       value="{{$doctor->pin_code}}"
                                                                       placeholder="Pin Code" name="pin_code">
                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Aadhar No</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input type="text" class="form-control"
                                                                       value="{{$doctor->aadhar_no}}"
                                                                       placeholder="Aadhar No" name="aadhar_no">
                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Date Of Birth</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input id="dob" name="dob" value="{{$doctor->dob}}" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                                                                <script>
                                                                    function timeFunctionLong(input) {
                                                                        setTimeout(function() {
                                                                            input.type = 'text';
                                                                        }, 60000);
                                                                    }
                                                                </script>
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
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Profile Photo</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input  type="file" id="profile_photo"  name="profile_photo" accept="image/*">
                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Document Photo</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <div class="col-md-55">
                                                                    <div class="thumbnail">
                                                                        <div class="image view view-first">
                                                                            <a href="{{asset('upload_file/doctor/doctor_document/'.$doctor->document_photo)}}" target="_blank">
                                                                                <img style="width: 100%; display: block;" src="{{asset('upload_file/doctor/doctor_document/'.$doctor->document_photo)}}" alt="image">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <input  type="file" id="document_photo"  name="document_photo" accept="image/*" alt="{{$doctor->name}}">
                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Certificates</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                @foreach ($doctor->certificate as $certificate)
                                                                <div class="col-md-55">
                                                                    <div class="thumbnail">
                                                                        <div class="image view view-first">
                                                                            <a href="{{asset($certificate->certificate_file_path)}}" target="_blank">
                                                                                <img style="width: 100%; display: block;" src="{{asset($certificate->certificate_file_path)}}" alt="{{$certificate->degree_name}}">
                                                                            </a>
                                                                        </div>
                                                                        <div class="caption">
                                                                            <p style="text-align: center; height: 10px;">{{$certificate->degree_name}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                            </div>

                                                        </div>
                                                        <div class="ln_solid"></div>
                                                        <div class="form-group">
                                                            <div class="col-md-9 col-sm-9  offset-md-3">
                                                                <a href="{{route('doctor.index')}}">
                                                                    <button type="button" class="btn btn-primary">Cancel
                                                                    </button>
                                                                </a>
                                                                <button type="reset" class="btn btn-primary">Reset
                                                                </button>
                                                                <a href="{{route('doctor.doctor_delete', $doctor->id)}}">
                                                                    <button type="button" class="btn btn-danger">Delete
                                                                    </button>
                                                                </a>
                                                                <button class="btn btn-success">Submit
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <x-change-password id="{{$doctor->id}}" user-type="doctor" />
                                            <!-- Change E-mails Pop-Up -->
{{--                                            <div id="update_email_popup"></div>--}}
                                            <!-- /Change E-mails Pop-Up -->
                                            <!-- Change Mobile Pop-Up -->
{{--                                            <div id="update_mobile_popup"></div>--}}
                                            <!-- /Change Mobile Pop-Up -->
                                        </div>
                                        <!-- end Doctor details update -->
                                        <!-- start patient count -->
                                        <div role="tabpanel" class="tab-pane fade" id="patient_count"
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add more and remove button -->
    <script type="text/javascript">
        var i = 0;
        $("#add-btn").click(function(){
            ++i;
            $("#dynamicAddRemove").append('<tr><td><input type="text" name="degree['+i+']" placeholder="Enter Degree" class="form-control" /></td><td><input  type="file" id="certificates"  name="certificates['+i+']" accept="image/* "/></td><td><button type="button" class="btn btn-sm btn-danger remove-tr">Remove</button></td></tr>');
        });
        $(document).on('click', '.remove-tr', function(){
            $(this).parents('tr').remove();
        });
    </script>
    <!-- /Add more and remove button -->
@stop


