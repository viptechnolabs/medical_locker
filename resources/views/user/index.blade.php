@extends('layout.app')
@section('content')
    <!-- page content -->
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>User List</h3>
            </div>

            <div class="title_right">
                <div class="col-md-7 col-sm-7  form-group pull-right top_search">
                    <form action="" method="get">
                    <div class="input-group">
                             <input type="search" class="form-control" placeholder="Search for..." name="user_search">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">Go!</button>&ensp;
                             </span>

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


                    {!!$dataTable->table()  !!}

{{--                        <h4 style="margin:22px; text-align: center">No user inserted at time</h4>--}}

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

