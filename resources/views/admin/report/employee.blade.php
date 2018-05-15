@extends('layouts.table')

@section('title', 'Generate Employee Report')

@section('parent','Report')

@section('current','Employee')

@section('box-title', 'Employee Report')

@section('table-content')
    <thead>
    <tr>
        <th>Employee</th>
    </tr>
    </thead>
    <tbody>
    @php($i = 0)
        @foreach($users as $user)
            <tr>
                <td>
                <h4 class="panel-title">
                    <span class="glyphicon glyphicon-chevron-up pull-right" role="button" data-toggle="collapse"
                          data-parent="#accordion" href="#collapse{{$user->staffId}}" aria-expanded="true"
                          aria-controls="collapse{{$user->staffId}}" onclick="openChart({{$user->staffId}})"></span>

                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$user->staffId}}"
                       aria-expanded="true" aria-controls="collapse{{$user->staffId}}">
                        {{$user->firstname}}&nbsp;&nbsp;{{$user->username}}&nbsp;&nbsp;{{$user->lastname}}
                    </a>
                </h4>
                    <label>Choose Date:</label>
                    <div class="input-group">
                        <button type="button" class="btn btn-default pull-right" id="daterange-btn{{$user->staffId}}">
                                     <span>
                                       <i class="fa fa-calendar"></i> Date range picker
                                     </span>
                            <i class="fa fa-caret-down"></i>
                        </button>
                    </div>
                    <div id="collapse{{$user->staffId}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <div class="box">
                                <div class="box-header">
                                    <select id="chart{{$user->staffId}}" onclick="setChartType({{$user->staffId}});">
                                        <option>line</option>
                                        <option>pie</option>
                                        <option>doughnut</option>
                                        <option>bar</option>
                                    </select>

                                    <a class="dt-button buttons-html5 pull-right" tabindex="0" style="margin-left: 1%; cursor: pointer;" onclick="export_chart({{$user->staffId}});">
                                        <span class="glyphicon glyphicon-download-alt"></span> Export
                                    </a>
                                    <select id="time{{$user->staffId}}" class="pull-right" onclick="setTimeType({{$user->staffId}});">
                                        <option>In</option>
                                        <option>Out</option>
                                    </select>
                                </div>
                                <div class="box-body">
                                    <div style="border: 1px solid black" id="graph-container{{$user->staffId}}">
                                        <canvas id="canvas{{$user->staffId}}"></canvas>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @php($i++)
        @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>Employee</th>
    </tr>
    </tfoot>
@endsection


@section('custom_js')
    @include('layouts.employeeReportJs')
@endsection