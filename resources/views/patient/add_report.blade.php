@extends('layout.app')
@section('content')
    <!-- page content -->
    <div class="row">

        <div class="col-md-12 col-sm-12 ">
            <a href="{{route('patient.patient_details', $patient->id)}}"> Do your work, then step back. </a>
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add {{$patient->name}} Report</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form action="{{route('patient.submit_report')}}" method="POST" enctype="multipart/form-data" id="add_report">
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
                            <input type="hidden" id="id"  name="id" value="{{$patient->patient_id}}" class="form-control">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Patient id
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="patient_id"  name="patient_id" value="{{$patient->patient_id}}" class="form-control" placeholder="Patient id" readonly="readonly">
                            </div>
                        </div>

                        <div class="item form-group">
                            <input type="hidden" id="id"  name="id" value="{{$patient->id}}" class="form-control">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Name
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="name"  name="name" value="{{$patient->name}}" class="form-control" placeholder="Name" readonly="readonly">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Consultant Doctor</label>
                            <div class="col-md-6 col-sm-6 ">
                                <select id="consultant_doctor" name="consultant_doctor" class="form-control" >
                                    <option value="">Choose..</option>
                                    @foreach($doctors as $doctor)
                                        <option value="{{$doctor->id}}">{{$doctor->name}}&nbsp;&nbsp;({{$doctor->specialist}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="routine_checkup" class="col-form-label col-md-3 col-sm-3 label-align">Routine Checkup</label>
                            <div class="col-md-6 col-sm-6 ">
                                <div  class="radio-group mt-2">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" class="flat" value="yes" id="routine_checkup" name="routine_checkup"> Yes &nbsp;&nbsp;
                                        </label>
                                        <label>
                                            <input type="radio" class="flat" value="no" id="routine_checkup" name="routine_checkup" checked> No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Type</label>
                            <div class="col-md-6 col-sm-6">
                                <div class="radio-group mt-2">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" class=""  value="opd" id="type" name="type" checked> OPD &nbsp;&nbsp;
                                        </label>
                                        <label>
                                            <input type="radio" class="flat" value="indore" id="type" name="type"> Indore
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Treatment Name</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" class="form-control" id="treatment_name" name="treatment_name" placeholder="Treatment Name" >
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Insurance</label>
                            <div class="col-md-6 col-sm-6 ">
                                <div  class="radio-group">
                                    <div class="radio mt-2">
                                        <label>
                                            <input type="radio" class="flat" value="yes" id="insurance" name="insurance"> Yes &nbsp;&nbsp;
                                        </label>
                                        <label>
                                            <input type="radio" class="flat" value="no" id="insurance" name="insurance" checked> No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Consultant Date
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="consultant_date" name="consultant_date"  class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
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
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">File (Report)</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input  type="file" id="file"  name="file" accept="application/pdf">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <a href="{{route('patient.patient_details', $patient->id)}}"><button class="btn btn-primary" type="button">Cancel</button></a>
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


