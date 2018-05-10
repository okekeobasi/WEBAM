@extends('layouts.table')

@section('title', 'Employee Screen')

@section('content')
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle"
                         src="{{Storage::url($clients->file_path)}}" alt="User profile picture">

                    <h3 class="profile-username text-center">{{$clients->firstname ." ". $clients->lastname}}</h3>

                    <p class="text-muted text-center">{{$clients->username}}</p>

                    <ul class="list-group list-group-unbordered container-fluid">
                        <li class="list-group-item custom-list-item">
                            <b>Email</b> <a class="pull-right" style="font-size: smaller">{{$clients->email}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Department</b> <a class="pull-right">
                                {{App\Department::find($clients->departmentId)->department}}
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Status</b><a class="pull-right">
                                @if(strtolower($clients->status) == "active")
                                    <span class="label label-success">{{$clients->status}}</span>
                                @else
                                    <span class="label label-danger">{{$clients->status}}</span>
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
                <div class="tab-content">
                @include('layouts.dashboardActivity')
                <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
@endsection