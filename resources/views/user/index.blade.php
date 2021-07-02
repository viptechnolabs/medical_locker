@extends('layout.app')
@section('content')
    <!-- page content -->
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>User List</h3>
            </div>
            <div class="title_right">
                <div class="pull-right">
                    <a href="{{route('user.add_user')}}">
                        <button type="button" class="btn btn-primary btn-sm">
                            <i class="fa fa-user-plus"></i> &ensp; Add User
                        </button>
                    </a>
                    <a href="{{route('user.deleted_user')}}">
                        <button type="button" class="btn btn-danger btn-sm">
                            <i class="fa fa-user"></i> &ensp; Deleted User
                        </button>
                    </a>
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

                    {!!$dataTable->table()  !!}

                </div>
            </div>
        </div>
    </div>
    <!-- Change User status Pop-Up -->
    <div id="status_change_popup"></div>
    <!-- /Change User status Pop-Up -->
    <!-- /page content -->
    {!! $dataTable->scripts() !!}
@stop

