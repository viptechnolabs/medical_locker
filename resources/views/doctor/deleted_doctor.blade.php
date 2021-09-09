@extends('layout.app')
@section('content')
    <!-- page content -->
    <div class="">
        <a href="{{route('doctor.index')}}"> Do your work, then step back. </a>
        <div class="page-title">
            <div class="title_left">
                <h3>Deleted Doctor List</h3>
            </div>
            <div class="title_right">
                <div class="col-md-7 col-sm-7  form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Go!</button>&ensp;
                             </span>

                    </div>
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

                    @foreach ($doctors as $doctor)
                        <div class="col-md-4 col-sm-4  profile_details">
                            <div class="well profile_view">
                                <div class="col-sm-12">
                                    <h4 class="brief"><i>{{ucfirst($doctor->doctor_id)}}</i></h4>
                                    <div class="left col-md-7 col-sm-7">
                                        <h2>Dr.{{$doctor->name}}</h2>
                                        <p><strong>About: </strong> It's specialist of {{ucfirst($doctor->specialist)}} </p>
                                        <br>
                                        <ul class="list-unstyled">
                                            <li><i class="fa fa-phone-square user-profile-icon"></i>
                                                : {{$doctor->mobile_no}}</li>
                                            <li><i class="fa fa-calendar"></i>
                                                : {{date('d-m-Y', strtotime($doctor->dob)) }}</li>
                                        </ul>
                                    </div>
                                    <div class="right col-md-5 col-sm-5 text-center">
                                        <img src="{{$doctor->profile_photo ? asset('upload_file/doctor/'.$doctor->profile_photo) : asset('upload_file/default.png')}}" alt="" class="img-circle img-fluid">
                                    </div>
                                </div>
                                <div class=" profile-bottom text-center">
                                    <div class=" col-sm-5 emphasis">
                                        {{--                                    <h4 class="brief"><i>{{ucfirst($doctor->specialist)}}</i></h4>--}}
                                        <h4 class="brief"><i>@foreach ($doctor->certificate as $certificate)
                                                    {{$certificate->degree_name}},
                                                @endforeach</i></h4>
                                    </div>
                                    <div class=" col-sm-7 emphasis">
                                        <a class="border-button" href="javascript:;"
                                           onclick="StatusChange('{{ route('change_status_popup') }}','{{ route('restore', $doctor->id) }}', 'Are You Sure to restore Dr.{{$doctor->name}}...?', 'doctor')">
                                            <button type="button" class="btn btn-success btn-sm">
                                                Restore
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @empty($doctor)
                        <h4 style="margin:22px; text-align: center">No doctor inserted at time</h4>
                    @endempty
                    <div id="status_change_popup"></div>


                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@stop

