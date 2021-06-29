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
                <div class="col-md-7 col-sm-7  form-group pull-right top_search">
                    <form action="" method="get">
                    <div class="input-group">
                             <input type="search" class="form-control" placeholder="Search for..." name="patient_search">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">Go!</button>&ensp;
                             </span>

                        <a href="{{route('patient.add_patient')}}">
                            <button type="button" class="btn btn-primary btn-sm">
                                <i class="fa fa-users"></i> &ensp; Add Patients
                            </button>
                        </a>
{{--                        <a href="{{route('patient.deleted_patient')}}">--}}
{{--                            <button type="button" class="btn btn-danger btn-sm">--}}
{{--                                <i class="fa fa-user-md"></i> &ensp;  Patients--}}
{{--                            </button>--}}
{{--                        </a>--}}
                    </div>
                    </form>
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
                        @foreach($patients as $no => $patient)
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td><img src='{{$patient->profile_photo ? asset('upload_file/patient/'.$patient->profile_photo) : asset('upload_file/default.png')}}' width='100px' /></td>
                                <td>{{$patient->patient_id}}</td>
                                <td>{{$patient->name}}</td>
                                <td>{{$patient->email}}</td>
                                <td>{{$patient->mobile_no}}</td>
{{--                                <td align="center">--}}
{{--                                    <a type='button' class='btn btn-success btn-sm' href="{{route('patient.patient_details', $patient->id)}}"><i class='fa fa-plus'> </i> Add Report</a>--}}
{{--                                </td>--}}
                                <td align="center">
                                    <a type='button' class='btn btn-primary btn-sm' href="{{route('patient.patient_details', $patient->id)}}"><i class='fa fa-user'> </i> View Profile</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

{{--                        <h4 style="margin:22px; text-align: center">No patient inserted at time</h4>--}}

                </div>
            </div>
        </div>
    </div>
    <!-- Change patient status Pop-Up -->
    <div id="status_change_popup"></div>
    <!-- /Change patient status Pop-Up -->
    <!-- /page content -->
{{--    {!! $dataTable->scripts() !!}--}}
@stop

