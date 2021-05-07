@extends('layout.app')
@section('content')
    <!-- page content -->
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
                        {{--                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>--}}
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
                                         src="{{asset('images/'.$hospital[0]->logo)}}" alt="Avatar"
                                         title="Change the avatar" style="height: 220px; width: 220px">
                                </div>
                            </div>
                            <h3>{{$hospital[0]->name}}</h3>
                            <hr>

                            <ul class="list-unstyled user_data">
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
                                <div class="col-md-6">
                                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#recent_activity" id="home-tab"
                                                                                  role="tab" data-toggle="tab"
                                                                                  aria-expanded="true">Recent
                                                Activity</a>
                                        </li>
                                        <li role="presentation" class=""><a href="#patient_count" role="tab"
                                                                            id="profile-tab" data-toggle="tab"
                                                                            aria-expanded="false">Patient Count</a>
                                        </li>
                                        <li role="presentation" class=""><a href="#edit" role="tab" id="profile-tab2"
                                                                            data-toggle="tab"
                                                                            aria-expanded="false">Edit</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <div id="reportrange" class="pull-right"
                                         style="margin-top: 5px; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED">
                                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                        <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                                    </div>
                                </div>
                            </div>
                            {{--                                <!-- start of user-activity-graph -->--}}
                            {{--                                <div id="graph_bar" style="width:100%; height:280px;"></div>--}}
                            {{--                                <!-- end of user-activity-graph -->--}}

                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                <div id="myTabContent" class="tab-content">
                                    <div role="tabpanel" class="tab-pane active " id="recent_activity"
                                         aria-labelledby="home-tab">

                                        <!-- start recent activity -->
                                        <ul class="messages">
                                            <li>
                                                <img src="{{asset('images/img.jpg')}}" class="avatar" alt="Avatar">
                                                <div class="message_date">
                                                    <h3 class="date text-info">24</h3>
                                                    <p class="month">May</p>
                                                </div>
                                                <div class="message_wrapper">
                                                    <h4 class="heading">Desmond Davison</h4>
                                                    <blockquote class="message">Raw denim you probably haven't heard of
                                                        them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher
                                                        retro keffiyeh dreamcatcher synth.
                                                    </blockquote>
                                                    <br/>
                                                    <p class="url">
                                                        <span class="fs1 text-info" aria-hidden="true"
                                                              data-icon=""></span>
                                                        <a href="#"><i class="fa fa-paperclip"></i> User Acceptance
                                                            Test.doc </a>
                                                    </p>
                                                </div>
                                            </li>
                                            <li>
                                                <img src="{{asset('images/img.jpg')}}" class="avatar" alt="Avatar">
                                                <div class="message_date">
                                                    <h3 class="date text-error">21</h3>
                                                    <p class="month">May</p>
                                                </div>
                                                <div class="message_wrapper">
                                                    <h4 class="heading">Brian Michaels</h4>
                                                    <blockquote class="message">Raw denim you probably haven't heard of
                                                        them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher
                                                        retro keffiyeh dreamcatcher synth.
                                                    </blockquote>
                                                    <br/>
                                                    <p class="url">
                                                        <span class="fs1" aria-hidden="true" data-icon=""></span>
                                                        <a href="#" data-original-title="">Download</a>
                                                    </p>
                                                </div>
                                            </li>
                                            <li>
                                                <img src="{{asset('images/img.jpg')}}" class="avatar" alt="Avatar">
                                                <div class="message_date">
                                                    <h3 class="date text-info">24</h3>
                                                    <p class="month">May</p>
                                                </div>
                                                <div class="message_wrapper">
                                                    <h4 class="heading">Desmond Davison</h4>
                                                    <blockquote class="message">Raw denim you probably haven't heard of
                                                        them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher
                                                        retro keffiyeh dreamcatcher synth.
                                                    </blockquote>
                                                    <br/>
                                                    <p class="url">
                                                        <span class="fs1 text-info" aria-hidden="true"
                                                              data-icon=""></span>
                                                        <a href="#"><i class="fa fa-paperclip"></i> User Acceptance
                                                            Test.doc </a>
                                                    </p>
                                                </div>
                                            </li>
                                            <li>
                                                <img src="{{asset('images/img.jpg')}}" class="avatar" alt="Avatar">
                                                <div class="message_date">
                                                    <h3 class="date text-error">21</h3>
                                                    <p class="month">May</p>
                                                </div>
                                                <div class="message_wrapper">
                                                    <h4 class="heading">Brian Michaels</h4>
                                                    <blockquote class="message">Raw denim you probably haven't heard of
                                                        them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher
                                                        retro keffiyeh dreamcatcher synth.
                                                    </blockquote>
                                                    <br/>
                                                    <p class="url">
                                                        <span class="fs1" aria-hidden="true" data-icon=""></span>
                                                        <a href="#" data-original-title="">Download</a>
                                                    </p>
                                                </div>
                                            </li>

                                        </ul>
                                        <!-- end recent activity -->

                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="patient_count"
                                         aria-labelledby="profile-tab">

                                        <!-- start patient count -->
                                        <table class="data table table-striped no-margin">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Mouth & Year</th>
                                                <th>New Patient</th>
                                                <th class="hidden-phone">Old Patient</th>
                                                <th>Totle Patient</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <!-- end patient count -->

                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="edit" aria-labelledby="profile-tab">

                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h2>Hospital Details Update</h2>

                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                                                <br/>
                                                <form action="{{route('hospital_details_update')}}"
                                                      class="form-horizontal form-label-left" method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="form-group row ">
                                                        <label class="control-label col-md-3 col-sm-3 ">Name</label>
                                                        <div class="col-md-9 col-sm-9 ">
                                                            <input type="text" class="form-control" name="hospital_name"
                                                                   value="{{$hospital[0]->name}}"
                                                                   placeholder="Hospital Name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="control-label col-md-3 col-sm-3 "> Details
                                                        </label>
                                                        <div class="col-md-9 col-sm-9 ">
                                                            <textarea class="form-control" rows="3"
                                                                      name="hospital_details" placeholder="{{$hospital[0]->details}}">{{$hospital[0]->details}}</textarea>
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
                                                        <label class="control-label col-md-3 col-sm-3 ">Email</label>
                                                        <div class="col-md-7 col-sm-3 ">
                                                            <input type="email" class="form-control"
                                                                   value="{{$hospital[0]->email}}" placeholder="Email"
                                                                   name="hospital_email" readonly="readonly">
                                                        </div>
                                                        <button type="button" class="btn btn-secondary"
                                                                data-toggle="modal" data-target="#update_email">Update
                                                            Email
                                                        </button>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="control-label col-md-3 col-sm-3 ">Mobile
                                                            No</label>
                                                        <div class="col-md-6 col-sm-3 ">
                                                            <input type="text" class="form-control"
                                                                   value="{{$hospital[0]->mobile_no}}"
                                                                   placeholder="Mobile No" readonly="readonly" name="hospital_mobile_no">
                                                        </div>
                                                        <button type="button" class="btn btn-secondary"
                                                                data-toggle="modal" data-target="#update_mobile_no">
                                                            Update
                                                            Mobile Number
                                                        </button>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="control-label col-md-3 col-sm-3 ">Fex No</label>
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
                                                                   placeholder="Pin Cord No">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="control-label col-md-3 col-sm-3 "> Address
                                                        </label>
                                                        <div class="col-md-9 col-sm-9 ">
                                                            <textarea class="form-control" rows="3"
                                                                      name="hospital_address" placeholder="Address">{{$hospital[0]->address}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="control-label col-md-3 col-sm-3 ">Password</label>
                                                        <div class="col-md-9 col-sm-9 ">
                                                            <input type="password" class="form-control" value="" name="password">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="control-label col-md-3 col-sm-3 ">Confirm
                                                            Password</label>
                                                        <div class="col-md-9 col-sm-9 ">
                                                            <input type="password" class="form-control" value="" name="confirm_password">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="control-label col-md-3 col-sm-3 ">Hospital
                                                            Logo</label>
                                                        <div class="col-md-9 col-sm-9 ">
                                                            <input type="file" value="" name="hospital_logo">
                                                        </div>
                                                    </div>

                                                    <div class="ln_solid"></div>
                                                    <div class="form-group">
                                                        <div class="col-md-9 col-sm-9  offset-md-3">
                                                            <a href="{{route('index')}}">
                                                                <button type="button" class="btn btn-primary">Cancel
                                                                </button>
                                                            </a>
                                                            <button type="reset" class="btn btn-primary">Reset</button>

                                                            <button class="btn btn-success">Submit
                                                            </button>

                                                        </div>
                                                    </div>
                                                    <!-- update email -->
                                                    <div class="modal fade" id="update_email" tabindex="-1"
                                                         role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myModalLabel2">Update
                                                                        Email</h4>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h4>Email</h4>

                                                                    <input type="text" class="form-control"
                                                                           value="{{$hospital[0]->email}}"
                                                                           placeholder="Email">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close
                                                                    </button>
                                                                    <button type="button" class="btn btn-primary">Next
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /update email -->
                                                    <!-- update mobile no -->
                                                    <div class="modal fade" id="update_mobile_no" tabindex="-1"
                                                         role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myModalLabel2">Update
                                                                        Mobile Number</h4>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h4>Mobile Number</h4>

                                                                    <input type="text" class="form-control"
                                                                           value="{{$hospital[0]->mobile_no}}"
                                                                           placeholder="Email">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close
                                                                    </button>
                                                                    <button type="button" class="btn btn-primary">Next
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /update mobile no -->
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@stop

