@extends('layouts.table')

@section('title', 'Employee Screen')

@section('parent','Records')
@section('current','Viewer')

@section('content')
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    @if( Storage::url($user->file_path) !== "/storage/")
                        <img class="profile-user-img img-responsive img-circle"
                             src="{{Storage::url($user->file_path)}}" alt="User profile picture">
                    @else
                        <img class="profile-user-img img-responsive img-circle"
                             src="{{asset('dist/img/usericon.png')}}" class="img-circle" alt="User profile picture">
                    @endif

                    <h3 class="profile-username text-center">{{$user->firstname ." ". $user->lastname}}</h3>

                    <p class="text-muted text-center">{{$user->username}}</p>

                    <ul class="list-group list-group-unbordered container-fluid">
                        <li class="list-group-item custom-list-item">
                            <b>Email</b> <a class="pull-right" style="font-size: smaller">{{$user->email}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Department</b> <a class="pull-right">
                                {{App\Department::find($user->departmentId)->department}}
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Status</b><a class="pull-right">
                                @if(strtolower($user->status) == "active")
                                    <span class="label label-success">{{$user->status}}</span>
                                @else
                                    <span class="label label-danger">{{$user->status}}</span>
                                @endif
                            </a>
                        </li>
                    </ul>

                    <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
                    <li><a href="#biometrics" data-toggle="tab">Biometrics</a></li>
                    <li><a href="#manage" data-toggle="tab">Manage</a></li>
                    <li><a href="#viewer" data-toggle="tab">View</a></li>
                </ul>
                @if ($errors)
                    {{--$errors->first('message')--}}
                    @foreach ($errors->all() as $error)
                        <p class="text-warning" style="color: red; float: right;">{{ $error }}</p><br/>
                    @endforeach
                @endif
                <div class="tab-content">
                    @include('layouts.activityModal')
                    @include('layouts.biometricsModal')
                    @include('layouts.manageModal')
                    @include('layouts.viewerModal')
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
@endsection