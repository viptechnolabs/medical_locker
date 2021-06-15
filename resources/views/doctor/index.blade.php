@extends('layout.app')
@section('content')
    <!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Doctor List</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-7 col-sm-7  form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>&ensp;
                    </span>
                            <a href="{{route('doctor.add_doctor')}}">
                            <button type="button" class="btn btn-primary btn-sm">
                                <i class="fa fa-user-md"></i>  &ensp;  Add Doctor
                            </button>
                            </a>
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
                                    <div class="left col-sm-7">
                                        <h2>Dr.{{$doctor->name}}</h2>
                                        <p><strong></strong>{{$doctor->degree}}</p>
                                        <ul class="list-unstyled">
                                            <li><i class="fa fa-phone-square user-profile-icon"></i> : {{$doctor->mobile_no}}</li>
                                            <li><i class="fa fa-envelope user-profile-icon"></i> : {{$doctor->email }}</li>
                                            <li><i class="fa fa-calendar"></i> : {{date('d-m-Y', strtotime($doctor->dob)) }}</li>
                                        </ul>
                                    </div>
                                    <div class="right col-sm-5 text-center">
                                        <img src="{{asset('upload_file/doctor/'.$doctor->profile_photo)}}"  alt="" class="img-circle img-fluid">
                                    </div>
                                </div>
                                <div class=" bottom text-center">
                                    <div class=" col-sm-5 emphasis">
                                        <h4 class="brief"><i>{{ucfirst($doctor->specialist)}}</i></h4>
                                    </div>
                                    <div class=" col-sm-7 emphasis">
                                        <a class="border-button" href="javascript:;"
                                           onclick="StatusChange('{{ route('doctor.doc_change_status_popup') }}','{{ route('doctor.change_status', $doctor->id) }}')">
{{--                                        <a class="border-button" href="javascript:;"--}}
{{--                                           onclick="getEmailPopup('{{ route('doctor.doc_change_status',$doctor->id) }}', '', {{ $doctor->id }})">--}}
                                            <button type="button" class= "{{$doctor->status === 'active' ? 'btn btn-success btn-sm' : 'btn btn-secondary btn-sm'}}">
                                                {{ucfirst($doctor->status)}}
                                            </button>
                                        </a>
{{--                                        <button type="button" class= "{{$doctor->status === 'active' ? 'btn btn-success btn-sm' : 'btn btn-secondary btn-sm'}} "data-toggle="modal" data-target="#change_status">{{ucfirst($doctor->status)}}</button>--}}
                                        <a href="{{route('doctor.doctor_details', $doctor->id)}}">
                                            <button type="button" class="btn btn-primary btn-sm">
                                                <i class="fa fa-user"> </i> View Profile
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
{{--                        <x-doctor-status/>--}}
                        @endforeach
                        @empty($doctor)
                            <h4 style="margin:22px; text-align: center">No Doctor inserted at time</h4>
                        @endempty
                        <div id="status_change_popup"></div>
                    </div>
                </div>
            </div>
        </div>
    <!-- /page content -->
@stop

