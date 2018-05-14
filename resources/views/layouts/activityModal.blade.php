<div class="active tab-pane" id="activity">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <!--  <h3 class="box-title">Today's Attendance</h3>-->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- Date and time range -->
                        <div class="form-group">
                            <label>Choose Date:</label>
                            <div class="input-group">
                                <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                                     <span>
                                       <i class="fa fa-calendar"></i> Date range picker
                                     </span>
                                    <i class="fa fa-caret-down"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                {{--<div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>--}}
                                <select id="chart" onclick="setChartType();">
                                    <option>line</option>
                                    <option>pie</option>
                                    <option>doughnut</option>
                                    <option>bar</option>
                                </select>

                                <a class="dt-button buttons-html5 pull-right" tabindex="0" style="margin-left: 1%; cursor: pointer;" onclick="export_chart();">
                                    <span>Export</span>
                                </a>
                                <select id="time" class="pull-right" onclick="setTimeType();">
                                    <option>In</option>
                                    <option>Out</option>
                                </select>
                            </div>
                            <div class="box-body">
                                <div style="border: 1px solid black" id="graph-container">
                                    <canvas id="canvas"></canvas>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.form group -->
                        <div class="table_mod">
                            <table id="example" class="table table-bordered table-striped table-hover js-exportable">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($Attendance as $row)
                                    <tr>
                                        <td>{{$row->date}}</td>
                                        <td>{{$row->time_in}}</td>
                                        <td>{{$row->time_out}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Date</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
    </section>
</div>
@include('layouts.custom_chartjs');
<!-- /.tab-pane -->