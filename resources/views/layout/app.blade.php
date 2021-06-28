<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('images/hospital.ico')}}" type="image/ico" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Add more and remove button -->

{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">--}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>




    <title>VIP TechnoLabs</title>

       <!-- Bootstrap -->

    <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('vendors/nprogress/nprogress.css')}}" rel="stylesheet">
{{--    <!-- Dropzone.js -->--}}
{{--    <link href="{{asset('vendors/dropzone/dist/min/dropzone.min.css')}}" rel="stylesheet">--}}

    <!-- iCheck -->
    <link href="{{asset('vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{asset('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{asset('vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet')}}"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('build/css/custom.min.css')}}" rel="stylesheet">
{{--    @livewireStyles--}}
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="{{route('index')}}" class="site_title"><i class="fa fa-hospital-o"></i> <span>VIP TechnoLabs</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="{{asset('upload_file/'.$hospital->logo)}}" alt="{$hospital->name}}" class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <h2>{{$hospital->name}}</h2>
                        <span>Digital Medical Locker</span>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>General</h3>
                        <ul class="nav side-menu">
                            <li><a href="{{route('index')}}"><i class="fa fa-home"></i> Dashboard</a></li>
                        </ul>
                        @if(Auth::guard('hospital')->check())
                        <ul class="nav side-menu">
                            <li><a href="{{route('doctor.index')}}"><i class="fa fa-user-md"></i> Doctors</a></li>
                        </ul>
                        <ul class="nav side-menu">
                            <li><a href="{{route('user.index')}}"><i class="fa fa-user"></i> Users</a></li>
                        </ul>
                        @endif
                        <ul class="nav side-menu">
                            <li><a href="{{route('patient.index')}}"><i class="fa fa-users"></i> Patients</a></li>
                        </ul>
                    </div>

                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Logout" href="#">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>


        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                    <ul class=" navbar-right">
                        <li class="nav-item dropdown open" style="padding-left: 15px;">
                            @if(Auth::guard('hospital')->check())
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <img src="{{asset('upload_file/'.Auth::guard('hospital')->user()->logo)}}" alt="{{Auth::guard('hospital')->user()->name}}">{{ Auth::guard('hospital')->user()->name}}
                                </a>
                            @elseif(Auth::guard('doctor')->check())
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <img src="{{asset('upload_file/doctor/'.Auth::guard('doctor')->user()->profile_photo)}}" alt="{{Auth::guard('hospital')->check()}}">{{ Auth::guard('doctor')->user()->name}}
                                </a>
                            @elseif(Auth::guard('web')->check())
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <img src="{{asset('upload_file/user/'.Auth::guard('web')->user()->profile_photo)}}" alt="{{Auth::guard('web')->check()}}">{{ Auth::guard('web')->user()->name}}
                                </a>
                            @endif
                            <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                @if(Auth::guard('hospital')->check())
                                    <a class="dropdown-item"  href="{{route('hospital_details')}}"> Setting</a>
                                @elseif(Auth::guard('doctor')->check())
                                    <a class="dropdown-item"  href="{{route('profile', ['doctor', Auth::guard('doctor')->user()->id])}}"> Profile</a>
                                @elseif(Auth::guard('web')->check())
                                    <a class="dropdown-item"  href="{{route('profile', ['user', Auth::guard('web')->user()->id])}}"> Profile</a>
                                @endif
                                <a class="dropdown-item"  href="{{route('logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->
        <div class="right_col" role="main">
            @yield('content')
        </div>

        <!-- footer content -->
        <footer>
            <div class="pull-right">
                <a href="#">VIP TechnoLabs</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>

<!-- jQuery -->
<script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    function disabledSubmitBtn(form) {
        $(form).find(':input[type=submit]').prop('disabled', true);
        $(form).find(':input[type=radio]:not(:checked)').attr("disabled", true);
    }
</script>
<script>
    function disabledSubmitBtn(form) {
        $(form).find(':input[type=submit]').prop('disabled', true);
        // $(form).find(':input[type=radio]:not(:checked)').attr("disabled", true);
    }
</script>
<!-- Bootstrap -->
<script src="{{asset('vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">



{{--<!-- Bootstrap JavaScript -->--}}
{{--<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>--}}
<!-- FastClick -->
<script src="{{asset('vendors/fastclick/lib/fastclick.js')}}"></script>
<!-- NProgress -->
<script src="{{asset('vendors/nprogress/nprogress.js')}}"></script>
<!-- morris.js -->
<script src="{{asset('vendors/raphael/raphael.min.js')}}"></script>
<script src="{{asset('vendors/morris.js/morris.min.js')}}"></script>
<!-- Chart.js -->
<script src="{{asset('vendors/Chart.js/dist/Chart.min.js')}}"></script>
<!-- gauge.js -->
<script src="{{asset('vendors/gauge.js/dist/gauge.min.js')}}"></script>
<!-- bootstrap-progressbar -->
<script src="{{asset('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('vendors/iCheck/icheck.min.js')}}"></script>
<!-- Skycons -->
<script src="{{asset('vendors/skycons/skycons.js')}}"></script>
<!-- Flot -->
<script src="{{asset('vendors/Flot/jquery.flot.js')}}"></script>
<script src="{{asset('vendors/Flot/jquery.flot.pie.js')}}"></script>
<script src="{{asset('vendors/Flot/jquery.flot.time.js')}}"></script>
<script src="{{asset('vendors/Flot/jquery.flot.stack.js')}}"></script>
<script src="{{asset('vendors/Flot/jquery.flot.resize.js')}}"></script>
<!-- Flot plugins -->
<script src="{{asset('vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
<script src="{{asset('vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
<script src="{{asset('vendors/flot.curvedlines/curvedLines.js')}}"></script>
<!-- DateJS -->
<script src="{{asset('vendors/DateJS/build/date.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
<script src="{{asset('vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
<script src="{{asset('vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{asset('vendors/moment/min/moment.min.js')}}"></script>
<script src="{{asset('vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
{{--<!-- bootstrap-wysiwyg -->--}}
{{--<script src="{{asset('vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js')}}"></script>--}}
{{--<script src="{{asset('vendors/jquery.hotkeys/jquery.hotkeys.js')}}"></script>--}}
{{--<script src="{{asset('vendors/google-code-prettify/src/prettify.js')}}"></script>--}}
<!-- jQuery Tags Input -->
<script src="{{asset('vendors/jquery.tagsinput/src/jquery.tagsinput.js')}}"></script>
{{--<!-- Switchery -->--}}
{{--<script src="{{asset('vendors/switchery/dist/switchery.min.js')}}"></script>--}}
{{--<!-- Select2 -->--}}
{{--<script src="{{asset('vendors/select2/dist/js/select2.full.min.js')}}"></script>--}}
{{--<!-- Parsley -->--}}
{{--<script src="{{asset('vendors/parsleyjs/dist/parsley.min.js')}}"></script>--}}
{{--<!-- Autosize -->--}}
{{--<script src="{{asset('vendors/autosize/dist/autosize.min.js')}}"></script>--}}
{{--<!-- jQuery autocomplete -->--}}
{{--<script src="{{asset('vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js')}}"></script>--}}
{{--<!-- starrr -->--}}
{{--<script src="{{asset('vendors/starrr/dist/starrr.js')}}"></script>--}}
{{--<!-- Dropzone.js -->--}}
{{--<script src="{{asset('vendors/dropzone/dist/min/dropzone.min.js')}}"></script>--}}
<!-- Custom Theme Scripts -->
<script src="{{asset('build/js/custom.min.js')}}"></script>
<!--Change Email Js-->
<script src="{{ asset('js/change_email.js') }}"></script>
<!--Change Mobile No Js-->
<script src="{{ asset('js/change_mobile_no.js') }}"></script>
<!--Change Status Js-->
<script src="{{ asset('js/change_status.js') }}"></script>
<!--Change password Js-->
<script src="{{ asset('js/change_password.js') }}"></script>
<!--Validation-->
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/validation_rules.js') }}"></script>
<script src="{{ asset('js/custom_validation_rules.js') }}"></script>
<script src="{{ asset('js/validation.js') }}"></script>
{{--<script src="{{ asset('js/file.js') }}"></script>--}}
{{--@livewireScripts--}}
</body>

</html>

