@extends('layouts.table')

@section('title','Manage Attendance Records')

@section('parent','Attendance')

@section('current','Records')

@section('box-mods')
  <!-- Date and time range -->
  <div class="row">
    <div class="col-md-10 col-md-offset-1" style="margin-top:0; margin-bottom: 5%; border: 1px solid #ccc; padding: 2%; border-top: 5px solid #ccc;">
      <div class="row">
        <form action="{{route('attendance.manage.fetch')}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
            <div class="form-group col-md- 10">
              <label>Choose Date:</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="date" class="form-control date-form" id="datepicker">
                <div class="input-group-addon">
                  <button class="custom-addon-button" name="action" value="search"><i class="fa fa-search" title="Submit"></i></button>
                </div>
              </div>
            </div>
        </form>
      </div>
      <div class="row">
        <button class="btn btn-success" data-toggle="modal" data-target="#createModal">
          <span class="glyphicon glyphicon-plus"></span> Create New
        </button>
      </div>
    </div>
  </div>
  <!--
  @if(isset($Attendance[0]->date))
    <form action="{{route('attendance.edit',$Attendance[0]->date)}}" method="post" enctype="multipart/form-data">
  @else
    <form action="{{route('attendance.edit',Carbon\Carbon::today('Europe/Berlin')->toDateString())}}" method="post" enctype="multipart/form-data">
  @endif
    {{csrf_field()}}
      <div class="form-group col-md-5">
        <label>Choose Time:</label>
        <div class="input-group bootstrap-timepicker">
          <div class="input-group-addon">
            <i id="setTimeButton" class="fa fa-clock-o"></i>
          </div>
          <input type="text" name="time" class="form-control date-form" id="timepicker">
        </div>
      </div>
  {{--<form>--}}
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1">
        <div class="input-group">
          <input type="text" name="username" class="form-control" placeholder="Employee Username" id="staff">
          <div class="input-group-addon">
            <button type="submit" class="custom-addon-button" name="action" value="Add"><i class="glyphicon glyphicon-plus-sign"></i></button>
          </div>
        </div>
      </div>
    </div>
      {{--<div class="col-sm-5 col-sm-offset-1">--}}
        {{--<input type="submit" class="btn btn-default btn-sm" name="action" value="Remove">--}}
      {{--</div>--}}
  </form>
  <br>
  -->
@endsection

@section('table-content')
  <thead>
  <tr>
    <th>ID</th>
    <th>Username</th>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>Date</th>
    <th>Method</th>
    <th>Time In</th>
    <th>Time Out</th>
    <th>Edit</th>
  </tr>
  </thead>
  <tbody>
  @foreach($Attendance as $row)
    <tr>
      <td>{{$row->id}}</td>
      <td>{{$users->find($row->user_id)->username}}</td>
      <td>{{$users->find($row->user_id)->firstname}}</td>
      <td>{{$users->find($row->user_id)->lastname}}</td>
      <td>{{$row->date}}</td>
      <td>
        @if(strtolower($row->method) == "online")
          <span class="label label-primary">{{$row->method}}</span>
        @else
          <span class="label label-success">{{$row->method}}</span>
        @endif
      </td>
      <td>{{$row->time_in}}</td>
      <td>{{$row->time_out}}</td>
      <td>
        <div class="row">
          @if(isset($Attendance[0]->date))
            <form action="{{route('attendance.del',$Attendance[0]->date)}}" method="post" enctype="multipart/form-data">
          @else
            <form action="{{route('attendance.del',Carbon\Carbon::today('Africa/Lagos')->toDateString())}}" method="post" enctype="multipart/form-data">
          @endif
              {{ csrf_field() }}
              <input type="hidden" name="id" value="{{$row->id}}">
              <button type="button" class="btn btn-primary btn-sm " data-toggle="modal" data-target="#editModal" onclick="setId('{{$row->id}}','{{$row->time_in}}','{{$row->time_out}}')">
                <span class="glyphicon glyphicon-pencil"></span>
              </button>
              <button type="submit" class="btn btn-danger btn-sm" name="action" value="Remove">
                <span class="glyphicon glyphicon-trash"></span>
              </button>
            </form>
        </div>
      </td>
    </tr>
  @endforeach
  </tbody>
  <tfoot>
  <tr>
    <th>ID</th>
    <th>Username</th>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>Date</th>
    <th>Method</th>
    <th>Time In</th>
    <th>Time Out</th>
    <th>Edit</th>
  </tr>
  </tfoot>
@endsection

@section('modal')
    <div class="modal fade" tabindex="-1" role="dialog" id="createModal" aria-labelledby="createModal">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Create New Record</h4>
          </div>
          <div class="modal-body" style="padding-bottom: 15%;">
            @if(isset($Attendance[0]->date))
              <form action="{{route('attendance.edit',$Attendance[0]->date)}}" method="post" enctype="multipart/form-data">
            @else
              <form action="{{route('attendance.edit',Carbon\Carbon::today('Africa/Lagos')->toDateString())}}" method="post" enctype="multipart/form-data">
            @endif
              {{csrf_field()}}
              <label>Choose Date:</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="date" class="form-control date-form" id="new_datepicker" required>
              </div>
                <br>
              <label>Choose Time:</label>
              <div class="input-group bootstrap-timepicker">
                <div class="input-group-addon">
                  <i id="setTimeButton" class="fa fa-clock-o"></i>
                </div>
                <input type="text" name="time" class="form-control date-form" id="timepicker" required>
              </div>
                <br>
              <input type="text" name="username" class="form-control" placeholder="Employee Username" id="staff" required>
                <hr>
              <button type="submit" class="pull-right btn btn-primary btn-sm" name="action" value="Add">
                <i class="glyphicon glyphicon-plus-check"></i> Submit
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>


  <div class="modal fade" tabindex="-1" role="dialog" id="editModal" aria-labelledby="editModal">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Record</h4>
        </div>
        <div class="modal-body" style="padding-bottom: 15%;">
          <form action="{{route('attendance.editTime')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <label>ID:</label>
            <input id="id" type="text" class="form-control" name="id" readonly="true">

            <label>Time In:</label>
            <div class="input-group bootstrap-timepicker">
              <div class="input-group-addon">
                <i id="setTimeButton" class="fa fa-clock-o"></i>
              </div>
              <input type="text" name="time_in" class="form-control date-form" id="in_timepicker">
            </div>

            <label>Time Out:</label>
            <div class="input-group bootstrap-timepicker">
              <div class="input-group-addon">
                <i id="setTimeButton" class="fa fa-clock-o"></i>
              </div>
              <input type="text" name="time_out" class="form-control date-form" id="out_timepicker">
            </div>
            <hr>
            <button type="submit" class="pull-right btn btn-primary btn-sm">
              <span class="glyphicon glyphicon-check"></span> Submit
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script>
    var id;
    function setId(num, t_in, t_out) {
        id = num;
        $('#id').attr('value',id);
        $('#in_timepicker').timepicker('setTime', t_in);
        $('#out_timepicker').timepicker('setTime', t_out);
        console.log(id, t_in, t_out);
    }
  </script>
@endsection