@extends('layouts.table')

@section('title', 'Department Screen')

@section('parent','Records')
@section('current','Viewer')

@section('content')
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <h3 class="profile-username text-center">{{$department->department}}</h3>
                    <h3 class="text-center">{{$department->population}}</h3>
                    <ul class="list-group list-group-unbordered container-fluid">
                        <li class="list-group-item custom-list-item">
                            <b>Resumption</b> <a class="pull-right" style="font-size: smaller">{{$department->resumption}}</a>
                        </li>
                        <li class="list-group-item custom-list-item">
                            <b>Closing</b> <a class="pull-right" style="font-size: smaller">{{$department->closing}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Status</b><a class="pull-right">
                                @if(strtolower($department->status) == "active")
                                    <span class="label label-success">{{$department->status}}</span>
                                @else
                                    <span class="label label-danger">{{$department->status}}</span>
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
                @include('layouts.department.ActivityModal')
                @include('layouts.department.ManageModal')
                @include('layouts.department.viewerModal')
                <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
@endsection

