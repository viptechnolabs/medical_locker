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
        <a href="{{route('user.index')}}"> Do your work, then step back. </a>
        <div class="page-title">
            <div class="title_left">
                <h3>Deleted User List</h3>
            </div>

            <div class="title_right">
                <div class="col-md-7 col-sm-7  form-group pull-right top_search">
                    <form action="" method="get">
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile No</th>
{{--                            <th>Status</th>--}}
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($users as $no => $user)
                            <tr>
                                <td> {{ $no + 1 }}</td>
                                <td><img
                                        src='{{$user->profile_photo ? asset('upload_file/user/'.$user->profile_photo) : asset('upload_file/default.png')}}'
                                        width='100px'/></td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->mobile_no}}</td>
{{--                                <td>--}}
{{--                                    <a class="border-button" href="javascript:;"--}}
{{--                                       onclick="StatusChange('{{ route('change_status_popup') }}','{{ route('change_status', $user->id) }}', 'Are You Sure to change Status...?', 'user')">--}}
{{--                                        <button type="button"--}}
{{--                                                class="{{$user->status === 'active' ? 'btn btn-success btn-sm' : 'btn btn-secondary btn-sm'}}">--}}
{{--                                            {{ucfirst($user->status)}}--}}
{{--                                        </button>--}}
{{--                                    </a>--}}
{{--                                </td>--}}
                                <td>
                                    <a class="border-button" href="javascript:;"
                                       onclick="StatusChange('{{ route('change_status_popup') }}','{{ route('restore', $user->id) }}', 'Are You Sure to restore...?', 'user')">
                                        <button type="button"
                                                class="btn btn-success btn-sm">
                                            Restore
                                        </button>
                                    </a>

                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

{{--                    {!!$dataTable->table()  !!}--}}

                </div>
            </div>
        </div>
    </div>
    <!-- Change User status Pop-Up -->
    <div id="status_change_popup"></div>
    <!-- /Change User status Pop-Up -->
    <!-- /page content -->
{{--    {!! $dataTable->scripts() !!}--}}
@stop

