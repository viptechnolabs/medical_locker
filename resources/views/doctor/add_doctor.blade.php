@extends('layout.app')
@section('content')
    <!-- page content -->
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add Doctor</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form action="{{route('doctor.submit_doctor')}}" method="POST" enctype="multipart/form-data">
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
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Name
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="name"  name="name"  class="form-control" required>
                            </div>
                        </div>
{{--                        <div class="item form-group">--}}
{{--                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Degree--}}
{{--                            </label>--}}
{{--                            <div class="col-md-6 col-sm-6 ">--}}
{{--                                <input type="text" id="degree" name="degree"  class="form-control" required>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Degree</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="tags_1" type="text" class="form-control" name="degree" />
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Specialist
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="specialist" name="specialist" class="form-control" required>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Email</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="email" class="form-control" type="text"  name="email" required>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Mobile No</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="mobile_no" class="form-control" type="text"  name="mobile_no">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Address</label>
                            <div class="col-md-6 col-sm-6 ">
                                <textarea class="form-control" rows="3"
                                          name="address"
                                          placeholder="Address"></textarea>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">State</label>
                            <div class="col-md-6 col-sm-6 ">
                                <select id="state" name="state" class="form-control" required>
                                    <option value="">Choose..</option>
                                    @foreach($states as $state)
                                     <option value="{{$state->name}}">{{$state->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">City</label>
                            <div class="col-md-6 col-sm-6 ">
                                <select id="city" name="city" class="form-control" required>
                                    <option value="">Choose..</option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->name}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Pin Code</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="pin_code" class="form-control" type="text"  name="pin_code" required>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Aadhar No</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="aadhar_no" class="form-control" type="text"  name="aadhar_no" required>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Gender</label>
                            <div class="col-md-6 col-sm-6 ">
                                <div id="gender" class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="gender" value="male" class="join-btn"> &nbsp; Male &nbsp;
                                    </label>
                                    <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="gender" value="female" class="join-btn"> Female
                                    </label>
                                    <label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="gender" value="transgender" class="join-btn"> &nbsp; Transgender &nbsp;
                                    </label>
                                    <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="gender" value="other" class="join-btn"> Other
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Date Of Birth
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="dob" name="dob" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                                <script>
                                    function timeFunctionLong(input) {
                                        setTimeout(function() {
                                            input.type = 'text';
                                        }, 60000);
                                    }
                                </script>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Profile Photo</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input  type="file" id="profile_photo"  name="profile_photo">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Certificates</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input  type="file" id="certificates"  name="certificates[]" multiple>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align"></label>
                            <div class="col-md-9 col-sm-3">
                                <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">(Press Ctrl To Select Multiple File)</label>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <a href="{{route('doctor.index')}}"><button class="btn btn-primary" type="button">Cancel</button></a>
                                <button class="btn btn-primary" type="reset">Reset</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@stop


