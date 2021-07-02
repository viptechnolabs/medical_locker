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
                                <td></td>
                                <td>{{$activity->created_at}}</td>
                                <td>{{$activity->causer->name}}</td>
                                <td>{{$activity->log_name}}</td>
                                <td id="msg">{{$activity->description}}</td>
                            </tr>
                        @endforeach

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

