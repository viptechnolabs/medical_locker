@extends('layout.app')
@section('content')
    <style>
        th, td {
            padding: 15px;
            text-align: center;
        }
    </style>
    <!-- page content -->
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Patient List</h3>
            </div>
            <div class="title_right">
                <div class="pull-right">
                    @if(!Auth::guard('doctor')->check())
                        <a href="{{route('patient.add_patient')}}">
                            <button type="button" class="btn btn-primary btn-sm">
                                <i class="fa fa-users"></i> &ensp; Add Patients
                            </button>
                        </a>
                    @endif
                    @if(!Auth::guard('web')->check())
                        <a href="{{ route('patient.patient_list_download') }}">
                            <button type="button" class="btn btn-success btn-sm">
                                <i class="fa fa-download fa-fw"></i> &ensp; Patients List Download
                            </button>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="x_panel">
                <div class="x_content">
                    <div class="col-md-12 col-sm-12  text-center">
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
                    </div>

                    <div class="clearfix"></div>

                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Profile Photo</th>
                            <th>Patient Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile No</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @if (Auth::guard('doctor')->check())
                            @foreach($patients as  $no =>  $patient_re)
                                @foreach($patient_re->patient as $patient)
                                    <tr>
                                        <td></td>
                                        <td><img
                                                src='{{$patient->profile_photo ? asset('upload_file/patient/'.$patient->profile_photo) : asset('upload_file/default.png')}}'
                                                width='100px'/></td>
                                        <td>{{$patient->patient_id}}</td>
                                        <td>{{$patient->name}}</td>
                                        <td>{{$patient->email}}</td>
                                        <td>{{$patient->mobile_no}}</td>
                                        <td align="center">
                                            <a type='button' class='btn btn-primary btn-sm'
                                               href="{{route('patient.patient_details', $patient->id)}}"><i
                                                    class='fa fa-user'> </i> View Profile</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endif
                        @if (Auth::guard('hospital')->check() or Auth::guard('web')->check() )
                            @foreach($patients as $no => $patient)
                                <tr>
                                    <td></td>
                                    <td><img
                                            src='{{$patient->profile_photo ? asset('upload_file/patient/'.$patient->profile_photo) : asset('upload_file/default.png')}}'
                                            width='100px'/></td>
                                    <td>{{$patient->patient_id}}</td>
                                    <td>{{$patient->name}}</td>
                                    <td>{{$patient->email}}</td>
                                    <td>{{$patient->mobile_no}}</td>
                                    <td align="center">
                                        <a type='button' class='btn btn-primary btn-sm'
                                           href="{{route('patient.patient_details', $patient->id)}}"><i
                                                class='fa fa-user'> </i> View Profile</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Change patient status Pop-Up -->
    <div id="status_change_popup"></div>
    <!-- /Change patient status Pop-Up -->
    <!-- /page content -->
@stop

