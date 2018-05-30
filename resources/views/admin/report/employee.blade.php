@extends('layouts.table')

@section('title', 'Generate Employee Report')

@section('parent','Report')

@section('current','Employee')

@section('content')
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                @php($i = 0)
                @foreach($users as $user)
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h4 class="panel-title">
                                <span class="glyphicon glyphicon-chevron-up pull-right" role="button" data-toggle="collapse"
                                      data-parent="#accordion" href="#collapse{{$user->staffId}}" aria-expanded="true"
                                      aria-controls="collapse{{$user->staffId}}" onclick="openChart({{$user->staffId}})"></span>

                                <a href="{{route('employee.scr', $user->staffId)}}"
                                   aria-expanded="true" aria-controls="collapse{{$user->staffId}}">
                                    {{$user->firstname}}&nbsp;&nbsp; `{{$user->username}}` &nbsp;&nbsp;{{$user->lastname}}
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
                                            <select id="chart{{$user->staffId}}" onclick="openChart({{$user->staffId}});">
                                                <option>line</option>
                                                <option>pie</option>
                                                <option>doughnut</option>
                                                <option>bar</option>
                                            </select>

                                            <a class="dt-button buttons-html5 pull-right" tabindex="0" style="margin-left: 1%; cursor: pointer;" onclick="export_chart({{$user->staffId}});">
                                                <span class="glyphicon glyphicon-download-alt"></span> Export
                                            </a>
                                            <select id="time{{$user->staffId}}" class="pull-right" onclick="openChart({{$user->staffId}});">
                                                <option>In</option>
                                                <option>Out</option>
                                            </select>
                                        </div>
                                        <div class="box-body">
                                            <div style="border: 1px solid black" class="size-chart" id="graph-container{{$user->staffId}}">
                                                <canvas id="canvas{{$user->staffId}}"></canvas>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php($i++)
                @endforeach
            </div>
        </div>
    </div>
@endsection


@section('custom_js')
    @include('layouts.employeeReportJs')
@endsection