@extends('layout.app')
@section('content')
    <!-- page content -->
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <a href="{{route('doctor.index')}}"> Do your work, then step back. </a>
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add Doctor</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
                    <form action="{{route('doctor.submit_doctor')}}" method="POST" enctype="multipart/form-data"
                          id="add_doctor">
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
                                <input type="text" id="name" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Degree</label>
                            <div class="col-md-6 col-sm-6 ">
                                <table class="table " id="dynamicAddRemove">
                                    <tr>
                                        <td><input type="text" id="degree" name="degree[0]" placeholder="Enter Degree"
                                                   class="form-control"/></td>
                                        <td><input type="file" id="certificates" name="certificates[0]"
                                                   accept="image/*" onchange="preview_image()"/></td>
                                        <td>
                                            <button type="button" name="add" id="add-btn"
                                                    class="btn btn-sm btn-success">Add More
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                                <div id="image_preview"></div>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Specialist
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="specialist" name="specialist" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Email</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="email" class="form-control" type="text" name="email">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Mobile
                                No</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="mobile_no" class="form-control" type="text" name="mobile_no">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name"
                                   class="col-form-label col-md-3 col-sm-3 label-align">Address</label>
                            <div class="col-md-6 col-sm-6 ">
                                <textarea class="form-control" rows="3"
                                          name="address"
                                          placeholder="Address"></textarea>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">State</label>
                            <div class="col-md-6 col-sm-6 ">
    {{--                                <select id="state" name="state" class="form-control">--}}
{{--                                    <option value="">Choose..</option>--}}
{{--                                    @foreach($states as $state)--}}
{{--                                        <option value="{{$state->name}}">{{$state->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
                                <x-state select-state=""/>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">City</label>
                            <div class="col-md-6 col-sm-6" id="getCityList">
{{--                                <select id="city" name="city" class="form-control">--}}
{{--                                    <option value="">Choose..</option>--}}
{{--                                    @foreach($cities as $city)--}}
{{--                                        <option value="{{$city->name}}">{{$city->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
                                <x-city/>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Pin
                                Code</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="pin_code" class="form-control" type="text" name="pin_code">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Aadhar
                                No</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="aadhar_no" class="form-control" type="text" name="aadhar_no">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="routine_checkup" class="col-form-label col-md-3 col-sm-3 label-align">Gender</label>
                            <div class="col-md-6 col-sm-6 ">
                                <div class="radio-group mt-2">
                                    <div class="radio">
                                        @foreach(App\Models\Hospital::GENDER as $key => $value )
                                            <label>
                                                <input type="radio" class="flat" value="{{ $key }}" id="routine_checkup"
                                                       name="gender"> {{ $value }} &nbsp;&nbsp;
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Date Of Birth
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="dob" name="dob" class="date-picker form-control" placeholder="dd-mm-yyyy"
                                       type="text" onfocus="this.type='date'" onmouseover="this.type='date'"
                                       onclick="this.type='date'" onblur="this.type='text'"
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
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Profile
                                Photo</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="file" id="profile_photo" name="profile_photo" accept="image/*" oninput="profile_preview.src=window.URL.createObjectURL(this.files[0])"/>
                                <img id="profile_preview" width="100px" />
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Document
                                Photo</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="file" id="document" name="document" accept="image/*"  oninput="document_preview.src=window.URL.createObjectURL(this.files[0])">
                                <img id="document_preview" width="100px" />
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <a href="{{route('doctor.index')}}">
                                    <button class="btn btn-primary" type="button">Cancel</button>
                                </a>
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
    <!-- Add more and remove button -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js" integrity="sha512-bztGAvCE/3+a1Oh0gUro7BHukf6v7zpzrAb3ReWAVrt+bVNNphcl2tDTKCBr5zk7iEDmQ2Bv401fX3jeVXGIcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        var i = 0;
        $("#add-btn").click(function () {
            ++i;
            $("#dynamicAddRemove").append('<tr><td><input type="text" name="degree[' + i + ']" placeholder="Enter Degree" class="form-control" /></td><td><input  type="file" id="certificates"  name="certificates[' + i + ']" accept="image/* " onchange="preview_image()"/></td><td><button type="button" class="btn btn-sm btn-danger remove-tr">Remove</button></td></tr>');
        });
        $(document).on('click', '.remove-tr', function () {
            $(this).parents('tr').remove();
        });
    </script>
    <!-- /Add more and remove button -->

    <script>
        function preview_image() {
            Array.from(event.target.files).filter(f => {
                return f.type.startsWith('image/')
            }).forEach((f) => {
                $('#image_preview').append("<img class='preview-image' src='" + URL.createObjectURL(f) + "' width='170px'> &emsp;");
            });
        }
    </script>

    <script>
        // $("#getStatesList").html(data);
        $('#state').change(function () {
            var stateId = $(this).val();
            $.ajax({
                type: 'POST',
                url: '{{ route('fetchCities') }}',
                data: {
                    stateId: stateId,
                    "_token": "{{ csrf_token() }}"
                },
                success: function (data) {
                    // alert("success");
                    $("#getCityList").html(data);
                }
            });
        });
    </script>

@stop


