@extends('layout.app')
@section('content')
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

