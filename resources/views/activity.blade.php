@extends('layout.app')
@section('content')
    <style>
        th, td {
            padding: 15px;
            text-align: center;
        }
        #msg {
            width: 50%;
            text-align: left;
        }
    </style>

    <!-- page content -->
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>All Activity List</h3>
            </div>

            <div class="title_right">
                <div class="col-md-7 col-sm-7  form-group pull-right top_search">
                    <form action="" method="get">
                    <div class="input-group">
                             <input type="search" class="form-control" placeholder="Search for..." name="patient_search">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">Go!</button>&ensp;
                             </span>

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
                    </div>

                    <div class="clearfix"></div>


                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Date/Time</th>
                            <th>User</th>
                            <th>Event Type</th>
                            <th>Message</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($activities as $no => $activity)
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td>{{$activity->created_at}}</td>
                                <td>{{$activity->causer->name}}</td>
                                <td>{{$activity->log_name}}</td>
                                <td id="msg">{{$activity->description}}</td>
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

