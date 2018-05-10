@extends('layouts.table')

@section('title','Attendance Records')

@section('parent','Attendance')

@section('current','Records')

@section('headerTitle', 'Attendance Records')

@section('box-mods')
    <!-- Date and time range -->
    <form action="{{route('attendance.fetch')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
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
        <!-- /.form group -->
    </form>
@endsection

@section('table-content')
    <thead>
    <tr>
        <th>Username</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Date</th>
        <th>Method</th>
        <th>Time In</th>
        <th>Time Out</th>
    </tr>
    </thead>
    <tbody>
    @foreach($Attendance as $row)
        <tr onclick="foo({{$row->id}})">
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
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>Username</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Date</th>
        <th>Method</th>
        <th>Time In</th>
        <th>Time Out</th>
    </tr>
    </tfoot>
@endsection