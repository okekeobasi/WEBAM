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
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <h3 class="profile-username text-center">Feedback</h3>
                    <hr>
                    <a class="btn btn-success btn-block" onclick="upvote()"><b><i class="fa fa-thumbs-up"></i></b></a>
                    <hr>
                    <a class="btn btn-danger btn-block" onclick="downvote()"><b><i class="fa fa-thumbs-down"></i></b></a>
                </div>
            </div>

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
                    @include('layouts.employee.activityModal')
                    @include('layouts.employee.biometricsModal')
                    @include('layouts.employee.manageModal')
                    @include('layouts.employee.viewerModal')
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
@endsection

@section('modal')
    <div class="modal fade" tabindex="-1" role="dialog" id="passModal" aria-labelledby="passModal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Enter your Office Email Password</h4>
                </div>
                <div class="modal-body" style="padding-bottom: 15%;">
                    <input type="password" name="modal_pass" class="form-control" id="modal_pass">
                    <br>
                    <button class="pull-right btn btn-primary btn-sm" onclick="feebackModal()">
                        Submit
                    </button>
                </div>
                <div class="modal-footer">
                    <span>Your password is encrypted and Secure</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
<script>
    var feedback = '';
    function upvote(){

        if(confirm('Would you like to send your feedback to {{$user->email}}')){
            feedback = 'upvote';
            $('#passModal').modal();
        }

    }

    function downvote() {

        if(confirm('Would you like to send your feedback to {{$user->email}}')){
            feedback = 'downvote';
            $('#passModal').modal();
        }

    }

    function feebackModal(){

        password = $('#modal_pass').val();
        action = 'POST';

         $.ajax({
             url: '{{route('mail.send')}}',
             type: action,
             data:{
             _method: action,
             _token: '{{csrf_token()}}',
             user_id: '{{$user->staffId}}',
             admin_id: '{{session()->get('staffId')}}',
             feedback: feedback,
             password: password
             },
             success: function(response){
                 alert('Your Email has been sent');
             },
             error: function (XMLHttpRequest, textStatus, errorThrown) {
                 alert("Status: " + textStatus);
                 alert("Error: " + errorThrown);
             },
             dataType: 'json'
         });
    }
</script>
@endsection